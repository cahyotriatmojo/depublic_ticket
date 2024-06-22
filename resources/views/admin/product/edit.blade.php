@extends('layouts.admin.app')
@section('content')
    <div class="my-5">
        <div class="container mx-auto max-w-xl shadow py-4 px-10">
            <a href="{{ route('index') }}" class="px-5 py-2 bg-red-500 rounded-md text-white text-lg shadow-md">Go Back</a>
            <div class="my-3">
                <h1 class="text-center text-3xl font-bold">Update Product</h1>
                <form action="" method="POST">
                    @csrf
                    <div class="my-2">
                        <label for="" class="text-md font-bold">Ticket Name</label>
                        <input type="text" value="{{ $ticket->name }}" name="name"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                            id="">
                        @error('name')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-2 ">
                        <label for="" class="text-md font-bold">Description</label>
                        <input type="text" value="{{ $ticket->description }}" name="description"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                            id="">
                        @error('description')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-2 ">
                        <label for="" class="text-md font-bold">Price</label>
                        <input type="text" value="{{ $ticket->price }}" name="price"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                            id="">
                        @error('price')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-2 ">
                        <label for="" class="text-md font-bold">Location</label>
                        <input type="text" value="{{ $ticket->location }}" name="location"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                            id="">
                        @error('location')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-2 ">
                        <label for="" class="text-md font-bold">Date</label>
                        <input type="date" value="{{ $ticket->date }}" name="date"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                            id="">
                        @error('date')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-2 ">
                        <label for="" class="text-md font-bold">Image</label>
                        <input type="file" value="{{ $ticket->image }}" name="image"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                            id="">
                        @error('image')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <button class="px-5 py-1 bg-emerald-500 rounded-md text-black text-lg shadow-md">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
