<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Pay;
use Illuminate\Support\Facades\Auth;
use Midtrans\Notification;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'required',
            'date' => 'required',
            'total' => 'required',
            'status' => 'pending', // Add this line
            'total_price' => 'required',
        ]);

        $package = Package::find($request->package_id);

        if (!$package) {
            return redirect()->back()->withErrors('Package not found.');
        }

        if ($package->quota < $request->total) {
            return redirect()->back()->withErrors('Not enough quota available.');
        }

        // Deduct quota
        $package->quota -= $request->total;
        $package->save();


        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_Key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $order_id = 'ORDER-' . uniqid();
        $params = array(
            'transaction_details' => array(
                'order_id' => $order_id,
                'gross_amount' => $request->total * $request->package_price,
            ),
            'customer_details' => array(
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ),

        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $transaction = new Pay();
        $transaction->package_id = $request->package_id;
        $transaction->total = $request->total;
        $transaction->date = $request->date;
        $transaction->total_price = $request->total * $request->package_price;
        $transaction->user_id = Auth::id();
        $transaction->snap_token = $snapToken;
        $transaction->order_id = $order_id;

        $transaction->save();

        return redirect()->route('booking.history');
    }

    public function cek(Pay $transaction)
    {
        $product = Package::find($transaction->package_id);

        return view('user.booking_ticket.bayar',  compact('transaction', 'product'));
    }

    public function notificationHandler(Request $request)
    {
        $notification = new Notification();

        $transaction = $notification->transaction_status;
        $type = $notification->payment_type;
        $orderId = $notification->order_id;
        $fraud = $notification->fraud_status;

        // Cari order berdasarkan ID
        $order = Pay::where('order_id', $orderId)->firstOrFail();

        if ($transaction == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $order->status = 'pending';
                } else {
                    $order->status = 'success';
                }
            }
        } elseif ($transaction == 'settlement') {
            $order->status = 'success';
        } elseif ($transaction == 'pending') {
            $order->status = 'pending';
        } elseif ($transaction == 'deny') {
            $order->status = 'failed';
        } elseif ($transaction == 'expire') {
            $order->status = 'failed';
        } elseif ($transaction == 'cancel') {
            $order->status = 'failed';
        }

        $order->save();

        return response()->json(['status' => 'success']);
    }

    public function updateStatus(Request $request)
    {
        $result = $request->all();

        // Cari order berdasarkan ID
        $order = Pay::where('order_id', $result['order_id'])->firstOrFail();

        // Perbarui status di database sesuai dengan status dari Midtrans
        if ($result['transaction_status'] == 'capture' || $result['transaction_status'] == 'settlement') {
            $order->status = 'success';
        } elseif ($result['transaction_status'] == 'pending') {
            $order->status = 'pending';
        } elseif ($result['transaction_status'] == 'deny' || $result['transaction_status'] == 'cancel' || $result['transaction_status'] == 'expire') {
            $order->status = 'failed';
        }

        $order->save();

        return response()->json(['status' => 'success']);
    }
}
