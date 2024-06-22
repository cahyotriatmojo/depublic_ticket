<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $tot_users = User::count();
        return view('admin.user.index', compact('users', 'tot_users'));
    }
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $users = User::all();
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    if ($data->role == 'admin') {
                        $actionBtn =
                    
                        '<div class="mt-2">' .
                        '<a href="' . route('user.edit', ['user' => $data->id]) . '" class="inline-block px-3 py-1 text-sm font-semibold text-blue-900 bg-blue-200 rounded-full hover:bg-blue-300">' .
                        'Edit' .
                        '</a>' .
                       '<form action="' . route('user.destroy', ['user' => $data->id]) . '" method="POST" style="display: inline;">' .
                        csrf_field() .
                        method_field('DELETE') .
                        '<button type="submit" class="inline-block px-2 py-1 text-xs font-semibold text-red-900 bg-red-200 rounded-full hover:bg-red-300" onclick="return confirm(\'Are you sure you want to delete this data?\')">' .
                        'Delete' .
                        '</button>' .
                        '</form>' .
                        '</div>';
                    }else{
                        $actionBtn = ''; 
                    }
                    
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Define the validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ];

        // Validate the request
        $request->validate($rules);
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' => Hash::make($request->password),
            ]);
            return redirect()->route('user.index')->with('success', "User Created");
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
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //dd($request->all());
        // Define the validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($request->id),
            ],
            'role' => 'required|string|max:255',
        ];

        // Validate the request
        $request->validate($rules);
        try {

            // Find the user by ID
            $user = User::findOrFail($request->id);

            // Update the user's data
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;

            // Only update the password if it is provided
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            // Save the changes
            $user->save();

            return redirect()->route('user.index')->with('success', "User Updated");
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            User::destroy($id);

            return redirect()->route('user.index')->with('success', "User Deleted");
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
