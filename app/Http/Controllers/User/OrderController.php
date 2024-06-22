<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Order;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index($package_id)
    {
        $package = Package::with('events')->where('id', $package_id)->first();
        return view('user.booking_ticket.booking', compact('package'));
    }

    public function store(Request $request, $package_id)
    {
        $package = Package::with('events')->where('id', $package_id)->first();

        session()->put([
            'order_date' => $request->date,
            'order_total' => $request->total,
            'order_price' => $package->price,
        ]);

        $minus_quota = $package->quota - $request->total;

        if ($minus_quota < 0) { 
            return redirect()->back()->withErrors(['error' => 'Quota sudah habis!']);
        } else {
            $package->update([
                'quota' => $minus_quota
            ]);

            return redirect()->route('booking.detail', $package_id);
        }

        //return view('user.booking_ticket.detail_booking', compact('package'));
    }

    public function detail($package_id)
    {
        $package = Package::with('events')->where('id', $package_id)->first();
        return view('user.booking_ticket.bayar', compact('package'));
    }

    public function storeDetail(Request $request, $package_id)
    {
        $package = Package::with('events')->where('id', $package_id)->first();
        Order::create([
            'user_id' => Auth::id(),
            'event_id' => $package->event_id,
            'package_id' => $package->id,
            'date' => session('order_date'),
            'total' => session('order_total'),
            'price' => session('order_price'),
            'contact_name' => $request->contact_name,
            'contact_phone' => $request->contact_phone,
            'contact_email' => $request->contact_email,
            'visitor_name' => $request->visitor_name,
            'visitor_phone' => $request->visitor_phone,
            'visitor_email' => $request->visitor_email,
            'visitor_card' => 'BRI',
        ]);
        session()->forget(['order_date', 'order_total', 'order_price']);
        return redirect()->route('booking.history');
    }
}
