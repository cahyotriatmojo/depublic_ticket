<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Order;
use App\Models\Package;
use App\Models\Pay;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = User::where('role', 'admin')->count();
        $user = User::where('role', 'user')->count();
        $event = Event::count();
        $transaction = Order::count();
        $mostOrderedEvent = Pay::join('packages', 'pays.package_id', '=', 'packages.id')
            ->join('events', 'packages.event_id', '=', 'events.id')
            ->select('packages.event_id', DB::raw('COUNT(*) as total_orders'))
            ->groupBy('packages.event_id')
            ->orderByDesc('total_orders')
            ->first();
        // Mendapatkan tanggal awal bulan ini
        $startOfMonth = Carbon::now()->startOfMonth()->toDateTimeString();
        // Mendapatkan tanggal akhir bulan ini
        $endOfMonth = Carbon::now()->endOfMonth()->toDateTimeString();

        // Menghitung total pendapatan untuk bulan ini saja
        $income = Pay::whereBetween('created_at', [$startOfMonth, $endOfMonth])
                    ->sum('total_price');
        // Ambil nama event berdasarkan event_id dari hasil query
        $eventName = '';
        if ($mostOrderedEvent) {
            $package = Package::with('events')->where('event_id',$mostOrderedEvent->event_id)->first();
            if ($package) {
                $eventName = $package->events->name;
            }
        }
        return view("admin.dashboard",compact("user", "admin", "event","transaction", 'eventName', 'income'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
