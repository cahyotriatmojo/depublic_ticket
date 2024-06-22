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
                <h1 class="text-center text-3xl font-bold">Update Event Ticket</h1>
                <form action="{{ route('event.update', ['event' => $event->id]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id" value="{{ $event->id }}">
                    <div class="my-2 ">
                        <label for="" class="text-md font-bold">Event Name</label>
                        <input type="text" name="name"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                            id="" required value="{{ $event->name }}">
                        @error('name')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-2 ">
                        <label for="" class="text-md font-bold">Descriptions</label>
                        <input type="text" name="description"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                            id="" required value="{{ $event->description }}">
                        @error('description')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-2 ">
                        <label for="" class="text-md font-bold">city</label>
                        <input type="text" name="city"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                            id="" value="{{ $event->city }}">
                        @error('city')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-2 ">
                        <label for="" class="text-md font-bold">Start_tanggal</label>
                        <input type="date" name="start_date"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                            id="" value="{{ $event->start_date }}">
                        @error('start_date')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-2 ">
                        <label for="" class="text-md font-bold">End_tanggal</label>
                        <input type="date" name="end_date"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                            id="" value="{{ $event->end_date }}">
                        @error('end_date')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-2 ">
                        <label for="" class="text-md font-bold">link</label>
                        <input type="text" name="gmap_link"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                            id="" value="{{ $event->gmap_link }}">
                        @error('gmap_link')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-2 ">
                        <label for="" class="text-md font-bold">location</label>
                        <input type="text" name="location"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                            id="" required value="{{ $event->location }}">
                        @error('location')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="my-2 ">
                        <label for="" class="text-md font-bold">Image</label>
                        <input type="file" name="image"
                            class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2"
                            id="">
                        <img class="my-4 h-auto max-w-sm rounded-lg shadow-xl dark:shadow-gray-800" src="{{ asset('public/product/'.$event->image) }}" alt="image description">
                        @error('image')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <h1 class="text-xl font-bold">Highlight</h1>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg my-3">
                        <table
                            class="highligth-table w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Highlight</th>
                                    <th scope="col" class="px-6 py-3 text-right">
                                        <button type="button" id="addRowBtnHG"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Add</button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($highlights as $highlight)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <input type="hidden" name="highlights[{{ $loop->index }}][id]"
                                                value="{{ $highlight->id }}">
                                            <input type="text" name="highlights[{{ $loop->index }}][text]"
                                                value="{{ $highlight->highlight }}"
                                                class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2">
                                            <input type="hidden" name="highlights[{{ $loop->index }}][delete]"
                                                value="0">
                                        </th>
                                        <td class="px-6 py-4 text-right">
                                            <button type="button"
                                                class="deleteRowBtnHG text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Delete</button>
                                        </td>
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
                                    <th scope="col" class="px-6 py-3">
                                        <button type="button" id="addRowBtn"
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Add</button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($packages as $package)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <input type="hidden" name="packages[{{ $loop->index }}][id]"
                                                value="{{ $package->id }}">
                                            <input type="text" name="packages[{{ $loop->index }}][name]"
                                                value="{{ $package->name }}"
                                                class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2">
                                        </th>
                                        <td class="px-6 py-4">
                                            <input type="text" name="packages[{{ $loop->index }}][description]"
                                                value="{{ $package->description }}"
                                                class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2">
                                        </td>
                                        <td class="px-6 py-4">
                                            <input type="number" name="packages[{{ $loop->index }}][price]"
                                                value="{{ $package->price }}"
                                                class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2">
                                        </td>
                                        <td class="px-6 py-4">
                                            <input type="number" name="packages[{{ $loop->index }}][quota]"
                                                value="{{ $package->quota }}"
                                                class="block w-full border border-emerald-500 outline-emerald-800 px-2 py-2 text-md rounded-md my-2">
                                            <input type="hidden" name="packages[{{ $loop->index }}][delete]"
                                                value="0">
                                        </td>
                                        <td class="px-6 py-4">
                                            <button type="button"
                                                class="deleteRowBtn text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                    <button class="px-5 py-1 bg-emerald-500 rounded-md text-black text-lg shadow-md">Save</button>
                    <a href="{{ route('event.index') }}"
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
            function reIndexInputs(tableBody, type) {
                tableBody.querySelectorAll('tr').forEach((row, index) => {
                    row.querySelectorAll('input').forEach(input => {
                        let nameMatch = input.name.match(/(\w+)\[\d+\](\[\w+\])?/);
                        if (nameMatch) {
                            let newName = `${nameMatch[1]}[${index}]${nameMatch[2] || ''}`;
                            input.name = newName;
                            console.log(`Re-indexed input name to: ${input.name}`);
                        }
                    });
                });
            }

            function addRow(tableBody, type) {
                let lastRow = tableBody.querySelector('tr:last-child');
                let newRow = lastRow.cloneNode(true);

                newRow.querySelectorAll('input[type="text"], input[type="number"]').forEach(input => input.value =
                    '');
                newRow.querySelector('input[name*="[id]"]').value = '';
                newRow.querySelector('input[name*="[delete]"]').value = '0';
                newRow.style.display = '';

                tableBody.appendChild(newRow);
                reIndexInputs(tableBody, type);

                console.log(`Added new row to ${type} table`);
            }

            document.getElementById('addRowBtnHG').addEventListener('click', function() {
                let tableBody = document.querySelector('.highligth-table tbody');
                addRow(tableBody, 'highlight');
            });

            document.getElementById('addRowBtn').addEventListener('click', function() {
                let tableBody = document.querySelector('.package-table tbody');
                addRow(tableBody, 'package');
            });

            function handleDelete(event, tableBody, type) {
                if (event.target && (event.target.classList.contains('deleteRowBtnHG') || event.target.classList
                        .contains('deleteRowBtn'))) {
                    let row = event.target.closest('tr');
                    row.querySelector('input[name*="[delete]"]').value = '1';
                    row.style.display = 'none'; // Hide the row instead of removing it
                    reIndexInputs(tableBody, type);
                    console.log(`Marked row for deletion in ${type} table`);
                }
            }

            document.querySelector('.highligth-table tbody').addEventListener('click', function(event) {
                handleDelete(event, this, 'highlight');
            });

            document.querySelector('.package-table tbody').addEventListener('click', function(event) {
                handleDelete(event, this, 'package');
            });
        });
    </script>
@endsection
