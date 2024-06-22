<x-user-layout>
    <!-- breadcumb -->
    <nav class="flex px-2 py-3 text-gray-700 rounded-lg bg-gray-50" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" class="inline-flex items-center text-md font-light text-gray-500 hover:text-purple-600">
                    Home
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="rtl:rotate-180  w-3 h-3 mx-1 text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ms-1 text-md font-medium text-purple-500 md:ms-2 dark:text-gray-400">
                        All Event</span>
                </div>
            </li>
        </ol>
    </nav>
    <!-- breadcumb end -->
    <!-- search -->
    <form action="{{ route('event') }}" method="GET" class="search flex gap-3 md:justify-between mb-10">
        <!-- Search Input -->
        <div class="relative flex-grow">
            <input type="search" name="search" value="{{ request('search') }}"
                class="block ps-10 py-2.5 pe-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-md border border-gray-300 focus:ring-transparent focus:border-gray-500"
                placeholder="Search Activities" onchange="this.form.submit()" />
        </div>
        <div class="location relative">
            <select id="location" name="location"
                class="appearance-none rounded-lg w-full ps-9 focus:ring-0 focus:border-yellow-200 bg-[#FDF9F0] border-[#FFF0CC]">
                <option value="" onchange="this.form.submit()">Location</option>
                @foreach ($cities as $city)
                    <option value="{{ $city->city }}" {{ request('location') == $city->city ? 'selected' : '' }}>
                        {{ $city->city }}</option>
                @endforeach
            </select>
        </div>
        </div>
        <!-- search end -->
        <!-- toolbar -->
        <div class="toolbar">
            <div class="flex justify-between items-center">
                <div class="title">
                    <h1 class="capitalize font-bold mx-3">All Events</h1>
                </div>
                <div class="btns flex gap-2 items-center">
                    <div class="filter">
                        <button
                            class="flex items-center rounded-full px-4 py-1 border border-slate-500 hover:bg-gray-100">
                            <span class="text-[#6B028D] mr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                    class="h-5 w-5 fill-current text-[#6B028D]"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path
                                        d="M3.9 54.9C10.5 40.9 24.5 32 40 32H472c15.5 0 29.5 8.9 36.1 22.9s4.6 30.5-5.2 42.5L320 320.9V448c0 12.1-6.8 23.2-17.7 28.6s-23.8 4.3-33.5-3l-64-48c-8.1-6-12.8-15.5-12.8-25.6V320.9L9 97.3C-.7 85.4-2.8 68.8 3.9 54.9z" />
                                </svg>
                            </span>
                            Filter
                        </button>
                    </div>
                    <div class="filter-container flex items-center space-x-4">
                        <div class="relative">
                            <input type="date" id="date" name="date" value="{{ request('date') }}"
                                min="{{ \Carbon\Carbon::today()->format('Y-m-d') }}"
                                class="block w-full rounded-full py-2.5 pl-10 pr-3 text-sm text-gray-900 bg-gray-50 border border-gray-300 focus:ring-transparent focus:border-gray-500"
                                placeholder="Date" />
                        </div>
                        <div class="relative">
                            <select name="sort_price" id="sort_price"
                                class="block w-full rounded-full py-2.5 pl-10 pr-3 text-sm text-gray-900 bg-gray-50 border border-gray-300 focus:ring-transparent focus:border-gray-500"
                                onchange="this.form.submit()">
                                <option value="">Price</option>
                                <option value="low_to_high" {{ request('sort_price') == 'low_to_high' ? 'selected' : '' }}>Harga Rendah ke Tinggi</option>
                                <option value="high_to_low" {{ request('sort_price') == 'high_to_low' ? 'selected' : '' }}>Harga Tinggi ke Rendah</option>
                            </select>
                        </div>                
                    </div>                    
                </div>
            </div>
        </div>
        </div>
        <!-- toolbar end -->
        <hr class="border border-slate-400 mt-4 mb-10">
        <!-- cards -->
        <div class="pagination-container">
            <div class="pagination-summary m-4">
                <p class="text-sm text-gray-700 leading-5">
                    Showing <span class="font-medium">{{ $events->firstItem() }}</span>
                    to <span class="font-medium">{{ $events->lastItem() }}</span>
                    of <span class="font-medium">{{ $events->total() }}</span> results
                </p>
            </div>
            <div id="eventsContainer" class="cards-container grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4 m-3">
                @foreach ($events as $event)
                    <div
                        class="max-w-sm bg-white border border-gray-200 rounded-lg flex flex-col gap-4 shadow dark:bg-gray-800 dark:border-gray-700 p-3">
                        <a href="{{ route('ticket.detail-event', ['slug' => $event->slug]) }}">
                            <img class="rounded-t-lg w-full h-64 object-cover" src="{{ asset('public/product/'.$event->image) }}" alt="{{ $event->name }}" />
                        </a>
                        <div class="location">
                            <div class="flex flex-wrap items-center justify-between">
                                <div class="flex space-x-2 items-center min-h-[40px]">
                                    <!-- Adjust min-h as needed -->
                                    <svg class="w-4 h-4 sm:w-6 sm:h-6 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.8 13.938h-.011a7 7 0 1 0-11.464.144h-.016l.14.171c.1.127.2.251.3.371L12 21l5.13-6.248c.194-.209.374-.429.54-.659l.13-.155Z" />
                                    </svg>
                                    <h6 class="text-xs sm:text-sm md:text-md text-gray-900">{{ $event->city }}
                                    </h6>
                                </div>
                                <h6 class="text-xs sm:text-sm md:text-md text-purple-500">|
                                    {{ \Carbon\Carbon::parse($event->start_date)->translatedFormat('l, d/m/Y') }}
                                </h6>
                            </div>
                        </div>
                        <div class="details">
                            <a href="{{ route('ticket.detail-event', ['slug' => $event->slug]) }}">
                                <h5
                                    class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white truncate">
                                    {{ $event->name }}</h5>
                            </a>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                {{ $event->truncatedDescription }}</p>
                            <h3 class="font-bold text-[#A103D3]">
                                Rp{{ number_format($event->getCheapestPackagePrice(), 0, ',', '.') }},00/<span
                                    class="font-normal text-black">1 person</span></h3>
                        </div>
                        <div class="cta-btn">
                            @if ($event->hasQuota)
                                <a href="{{ route('ticket.detail-event', ['slug' => $event->slug]) }}"
                                    class="capitalize w-full inline-block text-center rounded-xl px-4 py-2 bg-[#EAF2E2] text-[#0B640D]">tersedia</a>
                            @else
                                <button class="capitalize w-full rounded-xl px-4 py-2 bg-red-500 text-red-700"
                                    disabled>Habis</button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="pagination-links m-4">
                {{ $events->links() }}
            </div>
        </div>
        <!-- cards end -->
</x-user-layout>
