<?php

namespace App\Listeners;

use App\Events\UserActivity;
use App\Models\Event;
use App\Models\Package;
use App\Models\Pay;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class CheckTransactionStatus
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserActivity $event): void
    {
        // Ambil semua transaksi yang pending
        $transactions = Pay::where('status', 'pending')->get();

        foreach ($transactions as $transaction) {
            // Jika perbedaan waktu lebih dari 24 jam, update status transaksi menjadi failed
            if ($transaction->created_at->diffInHours(Carbon::now()) >= 24) {
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
            }
        }
    }
}
