@extends('layouts.admin.app')
@section('content')
    <div class="my-5">
        <div class="container mx-auto max-w-5xl shadow py-4 px-10">
            @if (session()->has('error'))
                <div class="bg-red-500 text-black px-4 py-2">
                    {{ session('error') }}
                </div>
            @endif
            <div class="my-3">
                <h1 class="text-center text-3xl font-bold">Detail Order</h1>
                <form method="POST" enctype="multipart/form-data">
                    <div class="my-2 ">
                        <label for="" class="text-md font-bold">User Name</label>
                        <input type="text" name="name"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                            id="" required value="{{ $pay->users->name }}" disabled>
                        @error('name')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-2 ">
                        <label for="" class="text-md font-bold">User Email</label>
                        <input type="text" name="name"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                            id="" required value="{{ $pay->users->email }}" disabled>
                        @error('name')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-2 ">
                        <label for="" class="text-md font-bold">Package</label>
                        <input type="text" name="description"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                            id="" required value="{{  $pay->packages->name }}" disabled>
                        @error('description')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-2 ">
                        <label for="" class="text-md font-bold">Total</label>
                        <input type="text" name="city"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                            id="" value="{{  $pay->total }}" disabled>
                        @error('city')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-2 ">
                        <label for="" class="text-md font-bold">Total Price</label>
                        <input type="text" name="start_date"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                            id="" value="IDR {{ number_format($pay->total_price, 0, ',', '.') }}" disabled>
                        @error('start_date')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-2">
                        <label for="" class="text-md font-bold">Date</label>
                        <input type="date" name="start_date"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                            id="" value="{{ $pay->date }}" disabled>
                        @error('start_date')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <a href="{{ route('order.index') }}"
                        class="px-5 py-2 bg-red-500 rounded-md text-white text-lg shadow-md my-3">Go
                        Back</a>
                </form>
            </div>
        </div>
    </div>
@endsection
