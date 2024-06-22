<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AllEventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::query();

        if ($request->has('search') && !empty($request->search)) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('city') && !empty($request->city)) {
            $query->where('city', $request->city);
        }

        if ($request->has('date') && !empty($request->date)) {
            $query->whereDate('start_date', $request->date);
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

        $cities = Event::select('city')
        ->distinct()
        ->orderBy('city', 'asc')
        ->get()
        ->pluck('city');

        return view('user.event.ticket', compact('events', 'cities'));
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

     

        // if ($request->has('price_order') && in_array($request->price_order, ['asc', 'desc'])) {
        //     $query->leftJoin('packages', 'events.id', '=', 'packages.event_id')
        //         ->select('events.*', DB::raw('MIN(packages.price) as min_price'))
        //         ->groupBy('events.id')
        //         ->orderBy('min_price', $request->price_order);
        // } else {
        //     $query->orderBy('created_at', 'desc');
        // }

        $events = $query->latest()->paginate(8);

        return response()->json($events);
    }

    public function detail($slug)
    {
        $event = Event::where('slug', $slug)->with('packages','highlights')->firstOrFail();
        $highlights = explode(',', $event->highlight); // Pecah teks highlight menjadi array

        return view('user.ticket.detail_ticket', compact('event', 'highlights'));
    }


}