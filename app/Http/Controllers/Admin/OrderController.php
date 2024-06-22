<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Pay;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function index(){
        return view("admin.transaction.index");
    }
    public function list(Request $request){
        if ($request->ajax()) {
            $orders = Pay::with('packages.events')
                ->with('users')
                ->get();
            return DataTables::of($orders)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $actionBtn =
                        '<div class="mt-2">' .
                        '<a href="' . route('order.show', ['order' => $data->id]) . '" class="inline-block px-2 py-1 text-xs font-semibold text-green-900 bg-green-200 rounded-full hover:bg-green-300">' .
                        'Detail' .
                        '</a>' .
                        '</div>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function show($id)
    {
        $pay = Pay::with('packages.events')->with('users')->where('id', $id)->first();
        return view('admin.transaction.detail', compact('pay'));
    }
}

