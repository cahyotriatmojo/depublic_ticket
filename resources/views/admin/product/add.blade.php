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
                <h1 class="text-center text-3xl font-bold">Create Event Ticket</h1>
                <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="my-2 ">
                        <label for="" class="text-md font-bold">Event Name</label>
                        <input type="text" name="name"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                            id="" required>
                        @error('name')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-2 ">
                        <label for="" class="text-md font-bold">Descriptions</label>
                        <input type="text" name="description"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                            id="" required>
                        @error('description')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-2 ">
                        <label for="" class="text-md font-bold">city</label>
                        <input type="text" name="city"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                            id="">
                        @error('city')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-2 ">
                        <label for="" class="text-md font-bold">Start_tanggal</label>
                        <input type="date" name="start_date"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                            id="">
                        @error('start_date')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-2 ">
                        <label for="" class="text-md font-bold">End_tanggal</label>
                        <input type="date" name="end_date"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                            id="">
                        @error('end_date')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-2 ">
                        <label for="" class="text-md font-bold">link</label>
                        <input type="text" name="gmap_link"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                            id="">
                        @error('gmap_link')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-2 ">
                        <label for="" class="text-md font-bold">location</label>
                        <input type="text" name="location"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                            id="" required>
                        @error('location')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-2 ">
                        <label for="" class="text-md font-bold">Image</label>
                        <input type="file" name="image"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                            id="" required>
                        @error('image')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <h1 class="text-xl font-bold">Highligth</h1>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg my-3">
                        <table
                            class="highligth-table w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Highligth
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right">
                                        <button type="button" id="addRowBtnHG"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Add</button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <input type="text" name="highlight_name[]"
                                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                                            id="">
                                    </th>
                                    <td class="px-6 py-4 text-right">
                                        <button type="button"
                                            class="deleteRowBtnHG text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h1 class="text-xl font-bold">Package</h1>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg my-3">
                        <table
                            class="package-table w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Description
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Price
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Quota
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        <button type="button" id="addRowBtn"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Add</button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <input type="text" name="package_name[]"
                                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                                            id="">
                                    </th>
                                    <td class="px-6 py-4">
                                        <input type="text" name="package_description[]"
                                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                                            id="">
                                    </td>
                                    <td class="px-6 py-4">
                                        <input type="number" name="package_price[]"
                                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                                            id="">
                                    </td>
                                    <td class="px-6 py-4">
                                        <input type="number" name="package_quota[]"
                                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                                            id="">
                                    </td>
                                    <td class="px-6 py-4">
                                        <button type="button"
                                            class="deleteRowBtn text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <button class="px-5 py-1 bg-emerald-500 rounded-md text-black text-lg shadow-md">Save</button>
                    <a href="{{ route('index') }}"
                        class="px-5 py-2 bg-red-500 rounded-md text-white text-lg shadow-md">Go
                        Back</a>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Function to add a new row to a specific table
            function addRow(tableBody) {
                let lastRow = tableBody.querySelector('tr:last-child');
                let newRow = lastRow.cloneNode(true);

                // Clear input values in the new row
                newRow.querySelectorAll('input').forEach(input => input.value = '');

                tableBody.appendChild(newRow);
            }
            // Add row button for Highligth table
            document.getElementById('addRowBtnHG').addEventListener('click', function() {
                let tableBody = document.querySelector('.highligth-table tbody');
                addRow(tableBody);
            });

            // Add row button for Package table
            document.getElementById('addRowBtn').addEventListener('click', function() {
                let tableBody = document.querySelector('.package-table tbody');
                addRow(tableBody);
            });
            // Event delegation for delete buttons
            document.querySelector('.highligth-table tbody').addEventListener('click', function(event) {
                if (event.target && event.target.classList.contains('deleteRowBtnHG')) {
                    let tableBody = document.querySelector('.highligth-table tbody');
                    let rows = tableBody.querySelectorAll('tr');
                    if (rows.length > 1) {
                        let row = event.target.closest('tr');
                        row.parentNode.removeChild(row);
                    } else {
                        alert("Cannot delete the last row.");
                    }
                }
            });

            document.querySelector('.package-table tbody').addEventListener('click', function(event) {
                if (event.target && event.target.classList.contains('deleteRowBtn')) {
                    let tableBody = document.querySelector('.package-table tbody');
                    let rows = tableBody.querySelectorAll('tr');
                    if (rows.length > 1) {
                        let row = event.target.closest('tr');
                        row.parentNode.removeChild(row);
                    } else {
                        alert("Cannot delete the last row.");
                    }
                }
            });
        });
    </script>
@endsection
