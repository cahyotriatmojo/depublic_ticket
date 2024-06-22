<x-user-layout>

    <!-- breadcumb -->
    <div class="container flex items-center gap-2 capitalize my-10">
        <div class="home">
            <a href="{{ route('home') }}" class="text-[#A103D3]">home</a>
        </div>
        <div class="arrow">
            <i class='bx bx-chevron-right'></i>
        </div>
        <div class="event text-[#A103D3]">
            Ticket
        </div>
    </div>
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
            <select id="location" name="city"
                class="appearance-none rounded-lg w-full ps-9 focus:ring-0 focus:border-yellow-200 bg-[#FDF9F0] border-[#FFF0CC]"
                onchange="this.form.submit()">
                <option value="">Location</option>
                @foreach ($cities as $city)
                    <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>
                        {{ $city }}
                    </option>
                @endforeach
            </select>
        </div>
        </div>
        <!-- search end -->

        <!-- toolbar -->
        <div class="toolbar">
            <div class="flex justify-between items-center">
                <div class="title">
                    <h1 class="capitalize font-bold">All Events</h1>
                </div>
                <div class="btns flex gap-2 items-center">
                    <button class="flex items-center rounded-full px-4 py-1 border border-slate-500 hover:bg-gray-100">
                        <span class="text-[#6B028D] mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                class="h-5 w-5 fill-current text-[#6B028D]"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path
                                    d="M3.9 54.9C10.5 40.9 24.5 32 40 32H472c15.5 0 29.5 8.9 36.1 22.9s4.6 30.5-5.2 42.5L320 320.9V448c0 12.1-6.8 23.2-17.7 28.6s-23.8 4.3-33.5-3l-64-48c-8.1-6-12.8-15.5-12.8-25.6V320.9L9 97.3C-.7 85.4-2.8 68.8 3.9 54.9z" />
                            </svg>
                        </span>
                        Filter
                    </button>
                    <div class="date relative">
                        <input type="date" name="date" value="{{ request('date') }}"
                            class="block w-full rounded-lg py-2.5 px-3 text-sm text-gray-900 bg-gray-50 border border-gray-300 focus:ring-transparent focus:border-gray-500" />
                    </div>
                    <div class="relative">
                        <select name="sort_price" id="sort_price"
                            class="block w-full rounded-full py-2.5 pl-10 pr-3 text-sm text-gray-900 bg-gray-50 border border-gray-300 focus:ring-transparent focus:border-gray-500"
                            onchange="this.form.submit()">
                            <option value="">Price</option>
                            <option value="low_to_high" {{ request('sort_price') == 'low_to_high' ? 'selected' : '' }}>
                                Harga Rendah ke Tinggi</option>
                            <option value="high_to_low" {{ request('sort_price') == 'high_to_low' ? 'selected' : '' }}>
                                Harga Tinggi ke Rendah</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <!-- toolbar end -->

        <hr class="border border-slate-400 mt-4 mb-10">

        <!-- cards -->
        <div class="subtitle mb-10">
            <p class="font-light"></p>
        </div>
        <div class="cards-container grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
            @foreach ($events as $event)
                <div
                    class="max-w-sm bg-white border border-gray-200 rounded-lg flex flex-col gap-4 shadow dark:bg-gray-800 dark:border-gray-700 p-3">
                    <a href="{{ route('ticket.detail-event', ['slug' => $event->slug]) }}">
                        <img class="rounded-lg" src="{{ asset('public/product/' . $event->image) }}" alt="Thumbnail" />
                    </a>
                    <div class="location">
                        <div class="flex gap-2">
                            <div>
                                <i class='bx bx-map'></i> {{ $event->location }}
                            </div>
                            <div class="border border-slate-500"></div>
                            <div class="text-[#6B028D]">
                                {{ Carbon\Carbon::parse($event->start_date)->format('M, d Y') }}
                            </div>
                        </div>
                    </div>
                    <div class="details">
                        <a href="#">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white truncate">
                                {{ $event->name }}</h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $event->description }}</p>
                        <h3 class="font-bold text-[#A103D3]">
                            Rp{{ number_format($event->getCheapestPackagePrice(), 0, ',', '.') }},00/<span
                                class="font-normal text-black">1 person</span></h3>
                    </div>
                    <div class="cta-btn">
                        <button type="button"
                            class="capitalize w-full rounded-xl px-4 py-2 bg-[#EAF2E2] text-[#0B640D]"
                            onclick="window.location.href = `{{ route('ticket.detail-event', ['slug' => $event->slug]) }}`">Buy
                            Now</button>


                    </div>
                </div>
            @endforeach
        </div>
        <!-- cards end -->
</x-user-layout>
