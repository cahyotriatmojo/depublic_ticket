<?php

namespace App\Http\Controllers\User;

use App\Helpers\TextHelper;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function index(Request $request)
{
    $query = Event::query();
    $today = Carbon::today();
    $events = $query->where('end_date', '>=', $today)
                    ->latest()
                    ->paginate(8);

        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->has('date') && !empty($request->date)) {
            $date = Carbon::parse($request->date)->toDateString();
            $query->whereDate('start_date', '=', $date);
        }
        if ($request->has('location') && !empty($request->location)) {
            $query->where('city', $request->location);
        }
        if ($request->has('sort_price') && !empty($request->sort_price)) {
            if ($request->sort_price == 'low_to_high') {
                $query->with('packages')->orderBy(function ($query) {
                    $query->selectRaw('MIN(price)')
                          ->from('packages')
                          ->whereColumn('event_id', 'events.id');
                }, 'asc');
            } elseif ($request->sort_price == 'high_to_low') {
                $query->with('packages')->orderBy(function ($query) {
                    $query->selectRaw('MIN(price)')
                          ->from('packages')
                          ->whereColumn('event_id', 'events.id');
                }, 'desc');
            }
        }
    
        $events = $query->latest()->paginate(8);
        $cities = Event::select('city')->distinct()->get(); // Ambil data kota
    
        return view('user.event.event', compact('events', 'cities', 'today'));
    }

    public function filterEvents(Request $request)
    {
        $query = Event::query();

        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('city') && !empty($request->city)) {
            $query->where('city', $request->city);
        }

        if ($request->has('date') && !empty($request->date)) {
            $query->whereDate('start_date', '>=', $request->date);
        }

        if ($request->has('min_price') && !empty($request->min_price)) {
            $query->whereHas('packages', function($q) use ($request) {
                $q->where('price', '>=', $request->min_price);
            });
        }

        if ($request->has('price_order') && in_array($request->price_order, ['asc', 'desc'])) {
            $query->leftJoin('packages', 'events.id', '=', 'packages.event_id')
                ->select('events.*', DB::raw('MIN(packages.price) as min_price'))
                ->groupBy('events.id')
                ->orderBy('min_price', $request->price_order);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $events = $query->latest()->paginate(8);

        return response()->json($events);
    }

    public function detail($slug)
    {
        $event = Event::where('slug', $slug)->with('packages','highlights')->firstOrFail();
        $highlights = explode(',', $event->highlight); // Pecah teks highlight menjadi array
        $threeDaysLater = Carbon::now()->addDays(1)->toDateString();
        $upcoming_events = Event::with('packages')
            ->where('start_date', '>' , $threeDaysLater)
            ->whereHas('packages')
            ->limit(10)
            ->get();
            foreach ($upcoming_events as $item) {
                $item->cheapestPackage = $item->packages->sortBy('price')->first();
                $item->truncatedDescription  = TextHelper::truncate($item->description, 50);
                $item->hasQuota = $item->packages->some(function ($package) {
                    return $package->quota > 0;
            });
        }
        $today = Carbon::today();

        return view('user.event.detail_event', compact('event', 'highlights', 'upcoming_events' , 'today'));
    }
}