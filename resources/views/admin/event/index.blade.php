@extends('layouts.admin.app')
@section('content')
    <div class="bg-gray-800 pt-3">
        <div class="rounded-tl-3xl bg-gradient-to-r from-blue-900 to-gray-800 p-4 shadow text-2xl text-white">
            <h1 class="font-bold pl-2">Events</h1>
        </div>
    </div>

    <div class="m-5">
        <div class="container mx-auto">
            @if (session()->has('success'))
                <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <div class="flex justify-end m-5">
                <a href="{{ route('event.create') }}" class="px-5 py-2 bg-blue-500 rounded-md text-white text-lg shadow-md">Add
                    New</a>
            </div>

            <div class="flex flex-col h-screen w-full">
                <div class="overflow-x-auto flex-1">
                    <div class="py-2 inline-block min-w-full px-6 lg:px-8">
                        <div class="rounded-lg shadow-lg">
                            <table
                                class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700 rounded-lg yajra-datatable">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left w-16">#
                                        </th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Name</th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Image</th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            City</th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Start Date</th>
                                        <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                    {{-- Data akan dimuat melalui AJAX --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('event.datatable') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'image',
                        name: 'image',
                        render: function(data, type, full, meta) {
                            return '<img src="' + '{{ asset("public/product") }}/' + data + '" class="w-20 h-auto">';
                        },
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'city',
                        name: 'city'
                    },
                    {
                        data: 'start_date',
                        name: 'start_date',
                        render: function(data, type, full, meta) {
                            var date = new Date(data);
                            return date.toLocaleDateString('en-GB'); // 'en-GB' locale formats as d/m/Y
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true,
                    },
                ],
                // Hapus opsi scrollX atau scrollY jika tidak diperlukan
            });
        });
    </script>
@endsection
