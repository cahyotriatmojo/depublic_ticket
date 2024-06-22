<?php

namespace App\Http\Controllers\User;

use App\Helpers\TextHelper;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $banners = Event::orderBy('created_at','DESC')->limit(5)->get();
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
        return view('user.home', compact('events','banners'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        $events = Event::where('name', 'LIKE', "%{$query}%")->get();
        
        return response()->json($events);
    }
}
