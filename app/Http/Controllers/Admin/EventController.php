<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Highlight;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Services\UploadFileService;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class EventController extends Controller
{
    public function __construct(public UploadFileService $uploadFileService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::orderBy('id', 'desc')->get();
        $total = Event::count();
        return view('admin.event.index', compact('events', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.event.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $path = $this->uploadFileService->uploadFile($request->file('image'));

        request()->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'gmap_link' => 'nullable|url',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $productId = $request->id;

        $image = $request->hidden_image;

        if ($files = $request->file('image')) {

            //delete old file
            File::delete('public/product/' . $request->hidden_image);

            //insert new file
            $destinationPath = 'public/product/'; // upload path
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $image = "$profileImage";
        }

        $event = Event::find($productId) ?? new Event();
        $event->image = $image;
        $event->name = $request->name;
        $event->city = $request->city;
        $event->location = $request->location;
        $event->gmap_link = $request->gmap_link;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->description = $request->description;
        $event->slug = Str::slug($request->name);

        // Ensure the slug is unique
        $originalSlug = $event->slug;
        $counter = 1;
        while (Event::where('slug', $event->slug)->exists()) {
            $event->slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $event->save();

        // Save highlights
        $highlights = $request->input('highlight_name', []);
        foreach ($highlights as $highlightName) {
            $event->highlights()->create(['highlight' => $highlightName]);
        }


        // Save packages
        $packageNames = $request->input('package_name', []);
        $packageDescriptions = $request->input('package_description', []);
        $packageQuotas = $request->input('package_quota', []);
        $packagePrices = $request->input('package_price', []);

        foreach ($packageNames as $index => $packageName) {
            if (!empty($packageName)) {
                $event->packages()->create([
                    'name' => $packageName,
                    'description' => $packageDescriptions[$index],
                    'quota' => $packageQuotas[$index],
                    'price' => $packagePrices[$index],
                ]);
            }
        }



        return redirect()->route('event.index')->with('success', "Product Added");
    }

    public function dataTable(Request $request)
    {
        if ($request->ajax()) {
            $events = Event::all();
            return DataTables::of($events)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $actionBtn =
                        '<div class="flex space-x-2 mt-2">' .
                        '<a href="' . route('event.show', ['event' => $data->id]) . '" class="inline-block px-2 py-1 text-xs font-semibold text-green-900 bg-green-200 rounded-full hover:bg-green-300">' .
                        'Detail' .
                        '</a>' .
                        '<a href="' . route('event.edit', ['event' => $data->id]) . '" class="inline-block px-2 py-1 text-xs font-semibold text-blue-900 bg-blue-200 rounded-full hover:bg-blue-300">' .
                        'Edit' .
                        '</a>' .
                        '<form action="' . route('event.destroy', ['event' => $data->id]) . '" method="POST" style="display: inline;">' .
                        csrf_field() .
                        method_field('DELETE') .
                        '<button type="submit" class="inline-block px-2 py-1 text-xs font-semibold text-red-900 bg-red-200 rounded-full hover:bg-red-300" onclick="return confirm(\'Are you sure you want to delete this data?\')">' .
                        'Delete' .
                        '</button>' .
                        '</form>' .
                        '</div>';

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $event = Event::where('id', $id)->first();
        $highlights = Highlight::where('event_id', $id)->get();
        $packages = Package::where('event_id', $id)->get();
        return view('admin.event.detail', compact('event', 'highlights', 'packages'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $event = Event::where('id', $id)->first();
        $highlights = Highlight::where('event_id', $id)->get();
        $packages = Package::where('event_id', $id)->get();
        return view('admin.event.edit', compact('event', 'highlights', 'packages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        request()->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'gmap_link' => 'nullable|url',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $image = $request->hidden_image;

        if ($files = $request->file('image')) {
            $path = $this->uploadFileService->uploadFile($request->file('image'));
            //delete old file
            File::delete('public/product/' . $request->hidden_image);

            //insert new file
            $destinationPath = 'public/product/'; // upload path
            $profileImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $image = "$profileImage";
        }

        $events = Event::findOrfail($request->id);
        $events->name = $request->name;
        $events->image = $request->image? $image : $events->image;
        $events->city = $request->city;
        $events->location = $request->location;
        $events->gmap_link = $request->gmap_link;
        $events->start_date = $request->start_date;
        $events->end_date = $request->end_date;
        $events->description = $request->description;
        $events->slug = Str::slug($request->name);

        $data = $events->save();

        // Handle Highlights
        if ($request->has('highlights')) {
            foreach ($request->highlights as $highlight) {
                Log::info('Highlight Data: ', $highlight);

                if (isset($highlight['delete']) && $highlight['delete'] == 1) {
                    if (isset($highlight['id'])) {
                        Log::info('Deleting highlight with id: ' . $highlight['id']);
                        Highlight::destroy($highlight['id']);
                    }
                } else {
                    Log::info('Updating or creating highlight with id: ' . ($highlight['id'] ?? 'new'));
                    Highlight::updateOrCreate(
                        ['id' => $highlight['id'] ?? null],
                        [
                            'highlight' => $highlight['text'],
                            'event_id' => $request->id,
                        ]
                    );
                }
            }
        }

        // Handle Packages
        if ($request->has('packages')) {
            foreach ($request->packages as $package) {
                Log::info('Package Data: ', $package);

                if (isset($package['delete']) && $package['delete'] == 1) {
                    if (isset($package['id'])) {
                        Log::info('Deleting package with id: ' . $package['id']);
                        Package::destroy($package['id']);
                    }
                } else {
                    Log::info('Updating or creating package with id: ' . ($package['id'] ?? 'new'));
                    Package::updateOrCreate(
                        ['id' => $package['id'] ?? null],
                        [
                            'event_id' => $request->id,
                            'name' => $package['name'],
                            'description' => $package['description'],
                            'price' => $package['price'],
                            'quota' => $package['quota']
                        ]
                    );
                }
            }
        }


        if ($data) {
            return redirect()->route('event.index')->with('success', 'Data updated successfully');
        } else {
            return redirect()->route('event.index')->with('success', 'Data updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the event
        $event = Event::find($id);

        if ($event) {
            // Delete the associated image file
            if ($event->image) {
                $imagePath = 'public/product/' . $event->image; // Assuming `image` is the column name storing the image path
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }

            // Delete the event
            $event->delete();

            // Delete associated highlights
            $highlights = Highlight::where('event_id', $id)->get();
            foreach ($highlights as $highlight) {
                $highlight->delete();
            }

            // Delete associated packages
            $packages = Package::where('event_id', $id)->get();
            foreach ($packages as $package) {
                $package->delete();
            }

            return redirect()->route('event.index')->with('success', "Event Deleted");
        } else {
            return redirect()->route('event.index')->with('error', "Event Not Found");
        }
    }
}
