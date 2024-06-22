<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Service\UploadFileService;
use Yajra\DataTables\Facades\DataTables;


class ProductController extends Controller

{
    public function __construct(public UploadFileService $uploadFileService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::orderBy('id', 'desc')->get();
        $total = Ticket::count();
        return view('admin.product.index', compact('tickets', 'total'));
    }

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $path = $this->uploadFileService->uploadFile($request->file('image'));

        request()->validate([
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

        $product = Ticket::find($productId) ?? new Ticket();
        // Set the individual attributes
        $product->id = $productId;
        $product->name = $request->name;
        $product->city = $request->city;
        $product->start_date = $request->start_date;
        $product->end_date = $request->end_date;
        $product->gmap_link = $request->gmap_link;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->image = $image;

        // Save the product
        $product->save();

        return redirect()->route('index')->with('success', "Product Added");
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
        $ticket = Ticket::findOrFail($id);
        return view('admin.product.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tickets = Ticket::findOrFail($id);
        $name = $request->name;
        $description = $request->description;
        $price = $request->price;
        $image = $request->image;
        $city = $request->city;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $gmap_link = $request->gmap_link;

        $tickets->city = $city;
        $tickets->start_date = $start_date;
        $tickets->end_date = $end_date;
        $tickets->gmap_link = $gmap_link;
        $tickets->name = $name;
        $tickets->description = $description;
        $tickets->price = $price;
        $tickets->image = $image;
        $data = $tickets->save();
        if ($data) {
            session()->flash('success', 'Product Update Successfully');
            return redirect(route('index'));
        } else {
            session()->flash('error', 'Some problem occure');
            return redirect(route('update'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tickets = Ticket::findOrFail($id);
        $data = $tickets->delete();
        if ($data) {
            session()->flash('success', 'Product Delete Successfully');
            return redirect(route('index'));
        } else {
            session()->flash('error', 'Some problem occure');
            return redirect(route('index'));
        }
    }
}
