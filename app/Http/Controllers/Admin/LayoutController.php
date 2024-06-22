<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;
use App\Service\UploadFileService;



class LayoutController extends Controller
{
    public function __construct(public UploadFileService $uploadFileService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tickets = Layout::orderBy('id', 'desc')->get();
        $total = Layout::count();
        return view('admin.product.index', compact('tickets', 'total'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.layout.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $path = $this->uploadFileService->uploadFile($request->file('image'));

            Layout::create([
                'name' => $request->name,
                'description' => $request->description,
                'image' => $path,
                'is_active' => $request->is_active == true ? 1:0,
            ]);

            return redirect()->route('admin.layouts.index')->with('success', "Product Layout Added");
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }

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
        $category = Layout::findOrFail($id);
        return view('admin.layout.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|max:255|string',
            'description' => 'required|max:255|string',
            'image' => 'nullable|mimes:png,jpg,jpeg,webp',
            'is_active' => 'sometimes'
        ]);

        $category = Layout::findOrFail($id);

        if($request->has('image')){

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();

            $filename = time().'.'.$extension;

            $path = 'uploads/category/';
            $file->move($path, $filename);

            if(File::exists($category->image)){
                File::delete($category->image);
            }
        }

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $path.$filename,
            'is_active' => $request->is_active == true ? 1:0,
        ]);

        return redirect()->back()->with('status','Category Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Layout::findOrFail($id);
        if(File::exists($category->image)){
            File::delete($category->image);
        }

        $category->delete();

        return redirect()->back()->with('status','Category Deleted');
    }
}
