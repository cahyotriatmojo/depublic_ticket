<?php

namespace App\Http\Controllers\User;

use App\Events\UserActivity;
use App\Helpers\TextHelper;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Pay;
use App\Models\Payment;
use App\Services\MidtransService;
use Carbon\Carbon;
use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected $midtrans;

    public function __construct(MidtransService $midtrans)
    {
        $this->midtrans = $midtrans;
    }
    
    public function index()
    {

        $transactions = Pay::where('user_id', Auth::user()->id)->get();

        $transactions->transform(function ($transaction) {
            $transaction->package = Package::find($transaction->package_id);
        });

        return view('transactions', compact('transactions'));
    }

    public function cancelOrder($orderId)
    {
        $response = $this->midtrans->cancelTransaction($orderId);
        
        $transaction = Pay::where('order_id', $orderId)->first();
        // if (isset($response['status_code']) && $response['status_code'] == 200) {
        //     return response()->json(['message' => 'Order cancelled successfully.']);
        // }

        $transaction->update(['status' => 'failed']);

        $package = Package::where('id', $transaction->package_id)->first();
        
        // Pastikan package ditemukan
        if ($package) {
            // Update quota package
            $package->update(['quota' => $package->quota + $transaction->total]);
        } else {
            // Log atau tangani jika package tidak ditemukan
            Log::warning("Package with ID {$transaction->package_id} not found for transaction ID {$transaction->id}");
        }

        return redirect()->route('booking.history');
    }

    public function history(Request $request)
    {
        event(new UserActivity($request->user()));

        $waitPage = $request->query('wait_page', 1);
        $completedPage = $request->query('completed_page', 1);
        $canceledPage = $request->query('canceled_page', 1);
        
        $payments = Pay::with('packages')
            ->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->paginate(5, ['*'], 'wait_page', $waitPage);

        $payments_complete = Pay::with('packages')
            ->where('user_id', Auth::id())
            ->where('status', 'success')
            ->orderBy('created_at', 'desc')
            ->paginate(5, ['*'], 'completed_page', $completedPage);
        
        $payments_failed = Pay::with('packages')
            ->where('user_id', Auth::id())
            ->where('status', 'failed')
            ->orderBy('created_at', 'desc')
            ->paginate(5, ['*'], 'canceled_page', $canceledPage);

        $threeDaysLater = Carbon::now()->addDays(1)->toDateString();
        $events = Event::with('packages')
            ->where('start_date', '>' , $threeDaysLater)
            ->whereHas('packages')
            ->limit(10)
            ->get();
            foreach ($events as $item) {
                $item->cheapestPackage = $item->packages->sortBy('price')->first();
                $item->truncatedDescription  = TextHelper::truncate($item->description, 50);
                $item->hasQuota = $item->packages->some(function ($package) {
                    return $package->quota > 0;
            });
        }
        return view('user.booking_ticket.history', compact('payments', 'payments_complete', 'payments_failed', 'events'));
    }

    public function show($id)
    {
        $payment = Pay::with('packages.events')->find($id);
        if (!$payment) {
            return response()->json(['error' => 'Payment not found'], 404);
        }

        return response()->json($payment);
    }

}
