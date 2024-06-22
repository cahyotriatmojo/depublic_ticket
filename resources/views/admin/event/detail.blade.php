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
                <h1 class="text-center text-3xl font-bold">Detail Event Ticket</h1>
                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="my-2 ">
                        <label for="" class="text-md font-bold">Event Name</label>
                        <input type="text" name="name"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                            id="" required value="{{ $event->name }}" disabled>
                        @error('name')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-2 ">
                        <label for="" class="text-md font-bold">Descriptions</label>
                        <input type="text" name="description"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                            id="" required value="{{ $event->description }}" disabled>
                        @error('description')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-2 ">
                        <label for="" class="text-md font-bold">City</label>
                        <input type="text" name="city"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                            id="" value="{{ $event->city }}" disabled>
                        @error('city')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-2 ">
                        <label for="" class="text-md font-bold">Start Date</label>
                        <input type="date" name="start_date"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                            id="" value="{{ $event->start_date }}" disabled>
                        @error('start_date')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-2 ">
                        <label for="" class="text-md font-bold">End Date</label>
                        <input type="date" name="end_date"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                            id="" value="{{ $event->end_date }}" disabled>
                        @error('end_date')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-2 ">
                        <label for="" class="text-md font-bold">link</label>
                        <input type="text" name="gmap_link"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                            id="" value="{{ $event->gmap_link }}" disabled>
                        @error('gmap_link')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-2 ">
                        <label for="" class="text-md font-bold">location</label>
                        <input type="text" name="location"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                            id="" required value="{{ $event->location }}" disabled>
                        @error('location')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-2 ">
                        <label for="" class="text-md font-bold">Image</label>
                        <img class="my-4 h-auto max-w-sm rounded-lg shadow-xl dark:shadow-gray-800" src="{{ asset('public/product/'.$event->image) }}" alt="image description">
                    </div>

                    <h1 class="text-xl font-bold">Highlight</h1>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg my-3">
                        <table
                            class="highligth-table w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Highlight</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($highlights as $highlight)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $highlight->highlight }}
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <h1 class="text-xl font-bold">Package</h1>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg my-3">
                        <table
                            class="package-table w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Name</th>
                                    <th scope="col" class="px-6 py-3">Description</th>
                                    <th scope="col" class="px-6 py-3">Price</th>
                                    <th scope="col" class="px-6 py-3">Quota</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($packages as $package)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4">
                                            {{ $package->name }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $package->description }}
                                        </td>
                                        <td class="px-6 py-4">
                                            Rp.{{ number_format($package->price, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $package->quota }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <a href="{{ route('event.index') }}"
                        class="px-5 py-2 bg-red-500 rounded-md text-white text-lg shadow-md">Go
                        Back</a>
                </form>
            </div>
        </div>
    </div>
@endsection
