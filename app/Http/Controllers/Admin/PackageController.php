<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packages = Package::all();
        $total = Package::count();
        return view('admin.package.index', compact('packages', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.package.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Package::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'quota' => $request->quota,
            ]);

            return redirect()->route('admin.packages.index')->with('success', "Package Added");
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
        $package = Package::findOrFail($id);
        return view('admin.package.edit', compact('package'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $package = Package::findOrFail($id);
        $package->name = $request->name;
        $package->description = $request->description;
        $package->price = $request->price;
        $package->quota = $request->quota;

        $data = $package->save();
        if ($data) {
            return redirect()->route('admin.packages.index')->with('success', "Package Updated");
        } else {
            return redirect()->route('admin.packages.index')->with('error', "Package Not Updated");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $package = Package::findOrFail($id);
        $package->delete();
        return redirect()->route('admin.packages.index')->with('success', "Package Deleted");
    }
}
