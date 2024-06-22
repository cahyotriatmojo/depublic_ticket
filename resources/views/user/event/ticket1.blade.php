<style>
    select.truncate {
        height: auto;
        max-height: 5rem;
        /* Adjust as needed */
        overflow-y: auto;
    }

    #datepicker {
        position: absolute;
        top: 60px;
        /* Adjust this value based on your requirements */
        left: 50%;
        /* Center horizontally */
        transform: translateX(-60%);
        /* Adjust for exact centering */
        z-index: 1000;
    }
</style>
<x-user-layout>
    <!-- breadcumb -->
    <nav class="flex px-2 py-3 text-gray-700 rounded-lg bg-gray-50" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="#" class="inline-flex items-center text-md font-light text-gray-500 hover:text-blue-600">
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
    <div class="search flex gap-3 md:justify-between mb-10">
        <!-- Search Input -->
        <div class="relative flex-grow">
            <input type="search" name="search" value="{{ request('search') }}"
                class="block ps-10 py-2.5 pe-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-md border border-gray-300 focus:ring-transparent focus:border-gray-500"
                placeholder="Search Events" />
        </div>
        <div class="location relative">
            <select id="city" name="city"
                class="appearance-none rounded-lg w-full max-w-xs ps-9 focus:ring-0 focus:border-yellow-200 bg-[#FDF9F0] border-[#FFF0CC] truncate">
                <option value="" selected disabled>Location</option>
                @foreach ($cities as $city)
                    <option value="{{ $city }}" {{ request('location') == $city ? 'selected' : '' }}>
                        {{ $city }}</option>
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
                <div class="btns flex items-center gap-2 mx-3">
                    <div class="filter">
                        <button type="submit" class="rounded-full px-4 py-1 border border-slate-500"><span
                                class="text-[#6B028D]"><i class='bx bx-filter'></i></span> filter</button>
                    </div>
                    <div class="date relative">
                        <button onclick="toggle_dp();" type="button" class="rounded-full px-4 py-1 border border-slate-500">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 10h16M8 14h8m-4-7V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
                            </svg>
                        </button>
                        <div id="datepicker"></div>
                        <div id="dateInputContainer" class="hidden mt-4">
                            <label for="dateInput" class="block text-sm font-medium text-gray-700">Select a date</label>
                            <input type="date" id="dateInput"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                    </div>
                    <div class="price relative">
                        <button id="priceButton" onclick="toggle_price();" class="rounded-full px-4 py-1 border border-slate-500">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.583 8.445h.01M10.86 19.71l-6.573-6.63a.993.993 0 0 1 0-1.4l7.329-7.394A.98.98 0 0 1 12.31 4l5.734.007A1.968 1.968 0 0 1 20 5.983v5.5a.992.992 0 0 1-.316.727l-7.44 7.5a.974.974 0 0 1-1.384.001Z" />
                            </svg>
                            <span id="priceOrderIcon"></span>
                        </button>
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
                        <a href="">
                            <img class="rounded-lg" src="{{ asset('/images/banner/konsermaherzain.jpg') }}"
                                alt="Thumbnail" />
                        </a>
                        <div class="location">
                            <div class="flex gap-2">
                                <div>
                                    <i class='bx bx-map'></i> {{ $event->city }}
                                </div>
                                <div class="border border-slate-500"></div>
                                <div class="text-[#6B028D]">
                                    {{ Carbon\Carbon::parse($event->start_date)->format('M, d Y') }}
                                </div>
                            </div>
                        </div>
                        <div class="details">
                            <a href="#">
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
                                <a href="{{ route('ticket.index', ['slug' => $event->slug]) }}"
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
<script>
    let priceOrder = 'asc';

    function toggle_dp() {
        const dp = $("#datepicker");
        const dateInputContainer = $('#dateInputContainer');

        if (dp.attr('datepicker')) {
            dp.datepicker('destroy');
            dp.removeAttr('datepicker');
            dateInputContainer.addClass('hidden');
        } else {
            dp.datepicker();
            dp.attr('datepicker', 1);
            //dateInputContainer.removeClass('hidden');
        }
    }

    $('#dateInput').on('change', function() {
        filterEvents();
    });

    function toggle_price() {
        priceOrder = (priceOrder === 'asc') ? 'desc' : 'asc';
        $('#priceOrderIcon').text(priceOrder === 'asc' ? '↓' : '↑');
        filterEvents();
    }

    function filterEvents() {
        const date = $('#dateInput').val();
        const url = '{{ route("filterEvents") }}';

        $.ajax({
            url: url,
            method: 'GET',
            data: {
                date: date,
                price_order: priceOrder,
            },
            success: function(response) {
                displayEvents(response.data);
            },
            error: function(error) {
                console.error(error);
            }
        });
    }

    function displayEvents(events) {
    const container = $('#eventsContainer');
    container.empty();

    if (events.length === 0) {
        container.append('<p>No events found</p>');
    } else {
        events.forEach(event => {
            const eventItem = `
                <div class="max-w-sm bg-white border border-gray-200 rounded-lg flex flex-col gap-4 shadow dark:bg-gray-800 dark:border-gray-700 p-3">
                    <a href="">
                        <img class="rounded-lg" src="/images/banner/konsermaherzain.jpg" alt="Thumbnail" />
                    </a>
                    <div class="location">
                        <div class="flex gap-2">
                            <div>
                                <i class='bx bx-map'></i> ${event.city}
                            </div>
                            <div class="border border-slate-500"></div>
                            <div class="text-[#6B028D]">
                                ${event.start_date}
                            </div>
                        </div>
                    </div>
                    <div class="details">
                        <a href="#">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white truncate">
                                ${event.name}
                            </h5>
                        </a>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                            ${event.truncatedDescription}
                        </p>
                        <h3 class="font-bold text-[#A103D3]">
                            Rp${event.getCheapestPackagePrice()},00/<span class="font-normal text-black">1 person</span>
                        </h3>
                    </div>
                    <div class="cta-btn">
                        ${event.hasQuota ? `<a href="/ticket/index/${event.slug}" class="capitalize w-full inline-block text-center rounded-xl px-4 py-2 bg-[#EAF2E2] text-[#0B640D]">tersedia</a>` 
                                        : `<button class="capitalize w-full rounded-xl px-4 py-2 bg-red-500 text-red-700" disabled>Habis</button>`}
                    </div>
                </div>
            `;
            container.append(eventItem);
        });
    }
}

</script>


