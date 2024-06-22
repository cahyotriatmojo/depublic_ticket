<style>
    .overlay-gradient {
        background: linear-gradient(to top, rgba(255, 255, 255, 1), rgba(255, 255, 255, 0));
    }

    .splide {
        overflow-x: hidden;
        /* Sembunyikan overflow horizontal pada container Splide */
    }

    .splide__slide {
        box-sizing: border-box;
        /* Pastikan padding tidak menambah lebar card */
        width: 100%;
        /* Gunakan lebar penuh untuk setiap card */
        margin-right: 0;
        /* Tidak ada margin antar slide */
    }

    .splide__slide img {
        width: 100%;
        /* Pastikan gambar dalam card menggunakan lebar penuh */
        border-radius: 8px;
        /* Atur border radius sesuai desain */
    }

    .splide__slide .p-5 {
        padding: 1rem;
        /* Sesuaikan padding sesuai kebutuhan */
    }

    @media (max-width: 425px) {
        .splide__slide {
            width: 100%;
            /* Gunakan lebar penuh pada layar kecil */
        }
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide/dist/css/splide.min.css">
<x-user-layout backgroundColor="bg-white">
    <!-- Breadcrumb -->
    <nav class="flex px-2 py-3 text-gray-700 rounded-lg bg-gray-50" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="#" class="inline-flex items-center text-md font-light text-gray-500 hover:text-blue-600">
                    Home
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-500 " aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <a href="{{ route('event') }}"
                        class="ms-1 text-md font-light text-gray-400 hover:text-blue-600 md:ms-2">Ticket</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="rtl:rotate-180  w-3 h-3 mx-1 text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ms-1 text-md font-medium text-purple-500 md:ms-2 dark:text-gray-400">Detail
                        Event</span>
                </div>
            </li>
        </ol>
    </nav>
    <div class="flex justify-center">
        <img class="m-3 h-auto w-full max-w-full sm:max-w-sm md:max-w-md lg:max-w-lg xl:max-w-xl 2xl:max-w-2xl rounded-lg"
            src="{{ asset('public/product/' . $event->image) }}" alt="image description">
    </div>
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-center">
            <div class="text-sm text-center text-gray-500 border-b border-gray-200">
                <ul class="flex flex-wrap -mb-px justify-center flex-nowrap overflow-x-auto">
                    <li class="mr-2">
                        <a href="#"
                            class="tab-link inline-block p-4 border-b-2 font-bold text-purple-700 border-purple-700 rounded-t-lg"
                            data-tab="summary">Summary</a>
                    </li>
                    <li class="mr-2">
                        <a href="#"
                            class="tab-link inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300"
                            data-tab="package">Package</a>
                    </li>
                    <li class="mr-2">
                        <a href="#"
                            class="tab-link inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300"
                            data-tab="location">Location</a>
                    </li>
                    <li class="mr-2">
                        <a href="#"
                            class="tab-link inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300"
                            data-tab="upcoming">Upcoming</a>
                    </li>
                </ul>
            </div>
        </div>

        <div id="summary" class="grid gap-4 xl:grid-cols-1 2xl:grid-cols-3 tab-content">
            <div class="p-4 bg-white 2xl:col-span-2 dark:border-gray-700 sm:p-6 mb-5">
                <div class="flex my-3">
                    <svg class="w-4 h-4 sm:w-8 sm:h-8 text-gray-500" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.8 13.938h-.011a7 7 0 1 0-11.464.144h-.016l.14.171c.1.127.2.251.3.371L12 21l5.13-6.248c.194-.209.374-.429.54-.659l.13-.155Z" />
                    </svg>
                    <h6 class="text-xs text-gray-900 sm:text-lg mr-1">{{ $event->location }}</h6>
                    <h6 class="text-xs text-purple-500 sm:text-lg">|
                        {{ Carbon\Carbon::parse($event->start_date)->format('M, d Y') }}</h6>
                </div>
                <h1 class="text-2xl font-bold text-gray-900 sm:text-2xl mb-3">{{ $event->name }}</h1>
                <div class="grid grid-cols-12 gap-4 mt-4">
                    <div class="col-span-7">
                        <p class="text-sm text-justify text-gray-500">
                            {{ $event->description }}
                        </p>
                    </div>
                    <div class="col-span-5 text-right">
                        <p class="text-sm font-semibold text-gray-500">Starting From</p>
                        <p class="text-lg font-bold text-purple-500">
                            Rp{{ number_format($event->getCheapestPackagePrice(), 0, ',', '.') }},00</p>
                    </div>
                </div>
                <h1 class="text-lg font-bold text-gray-900 sm:text-2xl mt-5 mb-3">Highlight</h1>
                <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside mx-2 text-sm text-justify">
                    @foreach ($event->highlights as $high)
                        <li>{{ $high->highlight }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div id="package" class="grid gap-4 xl:grid-cols-1 2xl:grid-cols-3 tab-content hidden">
            <div class="p-4 bg-white 2xl:col-span-2 sm:p-6 mb-5">
                <h1 class="text-xl font-bold text-gray-900 sm:text-2xl mb-8">Choose Package</h1>

                @foreach ($event->packages as $package)
                    <div class="p-4 shadow-md border bg-white 2xl:col-span-2 dark:border-gray-700 sm:p-6 mb-5">
                        <div class="flex justify-between mb-1">
                            <h1 class="text-sm font-bold text-gray-900 sm:text-2xl mb-3">{{ $package->name }}</h1>
                            <h1 class="text-sm font-bold text-gray-900 sm:text-2xl mb-3">Detail</h1>
                        </div>
                        <p class="text-sm text-justify text-gray-500">{{ $package->description }}</p>
                        <div class="border-t border-dashed border-purple-500 my-4"></div>
                        <div class="flex items-center justify-between mb-1">
                            <h1 class="text-sm font-bold text-purple-500 sm:text-2xl mb-0">IDR
                                {{ number_format($package->price, 0, ',', '.') }}</h1>
                            @if ($package->is_booked)
                                <button type="button"
                                    class="focus:outline-none text-white bg-green-500 hover:bg-green-700 
                            focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-xs px-3 py-1.5 mb-0 mr-0"
                                    disabled>Booked</button>
                            @else
                                <a href="{{ route('booking.index', ['package' => $package->id]) }}"
                                    class="focus:outline-none text-white bg-purple-500 hover:bg-purple-700 
                            focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-xs px-3 py-1.5 mb-0 mr-0">Select
                                    Package</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div id="location" class="grid gap-4 xl:grid-cols-1 2xl:grid-cols-3 tab-content hidden">
            <div class="p-4 bg-white 2xl:col-span-2 dark:border-gray-700 sm:p-6 mb-5">
                <h1 class="text-xl font-bold text-gray-900 sm:text-2xl mb-3">{{ $event->location }}</h1>
                <div class="relative flex justify-center">
                    <div
                        class="relative w-full max-w-full sm:max-w-sm md:max-w-md lg:max-w-lg xl:max-w-xl 2xl:max-w-2xl">
                        <img class="h-auto w-full rounded-lg" src="{{ asset('images/event/map.png') }}"
                            alt="image description">
                        <div class="absolute bottom-0 left-0 w-full bg-white bg-opacity-75 p-4 text-left rounded-b-lg">
                            <div class="flex items-center text-xs">
                                <svg class="w-4 h-4 text-purple-500" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M17.8 13.938h-.011a7 7 0 1 0-11.464.144h-.016l.14.171c.1.127.2.251.3.371L12 21l5.13-6.248c.194-.209.374-.429.54-.659l.13-.155Z" />
                                </svg>
                                <p class="bg-white p-2 rounded text-justify w-full">
                                    Jiexpo Hall B3 Pademangan Tim., Kec. Pademangan, Jkt Utara, Daerah Khusus
                                    Ibukota
                                    Jakarta 14410, Kemayoran, Jakarta Pusat, Jakarta, Indonesia
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-4 shadow-md border bg-white 2xl:col-span-2 dark:border-gray-700 sm:p-6 mb-5">
                    <a href="https://www.google.com/maps?q=Jiexpo+Hall+B3+Pademangan+Tim.,+Kec.+Pademangan,+Jkt+Utara,+Daerah+Khusus+Ibukota+Jakarta+14410,+Kemayoran,+Jakarta+Pusat,+Jakarta,+Indonesia"
                        target="_blank" rel="noopener noreferrer" class="flex items-center justify-between mb-1">
                        <h1 class="text-sm font-bold text-gray-900 sm:text-2xl">Direction</h1>
                        <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-500" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <div id="upcoming" class="grid gap-4 xl:grid-cols-1 2xl:grid-cols-3 tab-content hidden">
            <div class="flex items-center justify-between my-5">
                <h1 class="text-xl font-bold text-gray-900 sm:text-2xl">Upcoming Event</h1>
                <div class="flex space-x-2">
                    <button id="prev-button" class="focus:outline-none">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m15 19-7-7 7-7" />
                        </svg>
                    </button>
                    <button id="next-button" class="focus:outline-none">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m9 5 7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>

            <div id="splide" class="splide mb-3">
                <div class="splide__track">
                    <ul class="splide__list">
                        <li class="splide__slide max-w-sm bg-white border border-gray-200 rounded-lg shadow mx-auto">
                            <a href="#">
                                <img class="rounded-t-lg" src="{{ asset('images/event/event.png') }}"
                                    alt="" />
                            </a>
                            <div class="p-5">
                                <div class="flex my-3">
                                    <svg class="w-4 h-4 sm:w-6 sm:h-6 text-gray-500" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M17.8 13.938h-.011a7 7 0 1 0-11.464.144h-.016l.14.171c.1.127.2.251.3.371L12 21l5.13-6.248c.194-.209.374-.429.54-.659l.13-.155Z" />
                                    </svg>
                                    <h6 class="text-xs text-gray-900 sm:text-md mr-1">BANDUNG</h6>
                                    <h6 class="text-xs text-purple-500 sm:text-md">| DAY MON TANGGAL</h6>
                                </div>
                                <a href="#">
                                    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        Judul Event</h5>
                                </a>
                                <p class="mb-3 font-normal text-justify text-sm text-gray-400">Here are the biggest
                                    enterprise technology acquisitions of 2021 so far, in reverse chronological
                                    order.
                                </p>
                                <div class="flex my-3">
                                    <p class="text-lg font-bold text-purple-500">IDR 1.999.000</p>
                                    <span class="text-md text-gray-700">/1 Person</span>
                                </div>
                                <div class="cta-btn">
                                    <button
                                        class="capitalize w-full rounded-xl px-4 py-2 bg-[#EAF2E2] text-[#0B640D]">tersedia</button>
                                </div>
                            </div>
                        </li>
                        <li class="splide__slide max-w-sm bg-white border border-gray-200 rounded-lg shadow mx-auto">
                            <a href="#">
                                <img class="rounded-t-lg" src="{{ asset('images/event/event.png') }}"
                                    alt="" />
                            </a>
                            <div class="p-5">
                                <div class="flex my-3">
                                    <svg class="w-4 h-4 sm:w-6 sm:h-6 text-gray-500" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M17.8 13.938h-.011a7 7 0 1 0-11.464.144h-.016l.14.171c.1.127.2.251.3.371L12 21l5.13-6.248c.194-.209.374-.429.54-.659l.13-.155Z" />
                                    </svg>
                                    <h6 class="text-xs text-gray-900 sm:text-md mr-1">BANDUNG</h6>
                                    <h6 class="text-xs text-purple-500 sm:text-md">| DAY MON TANGGAL</h6>
                                </div>
                                <a href="#">
                                    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        Judul Event 1</h5>
                                </a>
                                <p class="mb-3 font-normal text-justify text-sm text-gray-400">Here are the biggest
                                    enterprise technology acquisitions of 2021 so far, in reverse chronological
                                    order.
                                </p>
                                <div class="flex my-3">
                                    <p class="text-lg font-bold text-purple-500">IDR 1.999.000</p>
                                    <span class="text-md text-gray-700">/1 Person</span>
                                </div>
                                <div class="cta-btn">
                                    <button
                                        class="capitalize w-full rounded-xl px-4 py-2 bg-[#EAF2E2] text-[#0B640D]">tersedia</button>
                                </div>
                            </div>
                        </li>
                        <li class="splide__slide max-w-sm bg-white border border-gray-200 rounded-lg shadow mx-auto">
                            <a href="#">
                                <img class="rounded-t-lg" src="{{ asset('images/event/event.png') }}"
                                    alt="" />
                            </a>
                            <div class="p-5">
                                <div class="flex my-3">
                                    <svg class="w-4 h-4 sm:w-6 sm:h-6 text-gray-500" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M17.8 13.938h-.011a7 7 0 1 0-11.464.144h-.016l.14.171c.1.127.2.251.3.371L12 21l5.13-6.248c.194-.209.374-.429.54-.659l.13-.155Z" />
                                    </svg>
                                    <h6 class="text-xs text-gray-900 sm:text-md mr-1">BANDUNG</h6>
                                    <h6 class="text-xs text-purple-500 sm:text-md">| DAY MON TANGGAL</h6>
                                </div>
                                <a href="#">
                                    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        Judul Event 2</h5>
                                </a>
                                <p class="mb-3 font-normal text-justify text-sm text-gray-400">Here are the biggest
                                    enterprise technology acquisitions of 2021 so far, in reverse chronological
                                    order.
                                </p>
                                <div class="flex my-3">
                                    <p class="text-lg font-bold text-purple-500">IDR 1.999.000</p>
                                    <span class="text-md text-gray-700">/1 Person</span>
                                </div>
                                <div class="cta-btn">
                                    <button
                                        class="capitalize w-full rounded-xl px-4 py-2 bg-[#EAF2E2] text-[#0B640D]">tersedia</button>
                                </div>
                            </div>
                        </li>
                        <li class="splide__slide max-w-sm bg-white border border-gray-200 rounded-lg shadow mx-auto">
                            <a href="#">
                                <img class="rounded-t-lg" src="{{ asset('images/event/event.png') }}"
                                    alt="" />
                            </a>
                            <div class="p-5">
                                <div class="flex my-3">
                                    <svg class="w-4 h-4 sm:w-6 sm:h-6 text-gray-500" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M17.8 13.938h-.011a7 7 0 1 0-11.464.144h-.016l.14.171c.1.127.2.251.3.371L12 21l5.13-6.248c.194-.209.374-.429.54-.659l.13-.155Z" />
                                    </svg>
                                    <h6 class="text-xs text-gray-900 sm:text-md mr-1">BANDUNG</h6>
                                    <h6 class="text-xs text-purple-500 sm:text-md">| DAY MON TANGGAL</h6>
                                </div>
                                <a href="#">
                                    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        Judul Event 3</h5>
                                </a>
                                <p class="mb-3 font-normal text-justify text-sm text-gray-400">Here are the biggest
                                    enterprise technology acquisitions of 2021 so far, in reverse chronological
                                    order.
                                </p>
                                <div class="flex my-3">
                                    <p class="text-lg font-bold text-purple-500">IDR 1.999.000</p>
                                    <span class="text-md text-gray-700">/1 Person</span>
                                </div>
                                <div class="cta-btn">
                                    <button
                                        class="capitalize w-full rounded-xl px-4 py-2 bg-[#EAF2E2] text-[#0B640D]">tersedia</button>
                                </div>
                            </div>
                        </li>
                        <!-- Additional slides here -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide/dist/js/splide.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var splide = new Splide('#splide', {
            type: 'loop',
            perPage: 1.5, // Display 1 slide per page
            perMove: 1,
            gap: '20px', // Gap between slides
            pagination: false,
            arrows: false,
            breakpoints: {
                640: {
                    perPage: 1.5, // Display 1 slide per page for small screens
                },
                768: {
                    perPage: 2,
                },
                1024: {
                    perPage: 3,
                },
            },
        }).mount();

        document.getElementById('prev-button').addEventListener('click', function() {
            splide.go('<');
        });

        document.getElementById('next-button').addEventListener('click', function() {
            splide.go('>');
        });
    });
    // JavaScript for tab functionality
    document.querySelectorAll('.tab-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            // Remove active class from all tabs
            document.querySelectorAll('.tab-link').forEach(link => {
                link.classList.remove('font-bold', 'text-purple-700', 'border-purple-700');
                link.classList.add('border-transparent', 'hover:text-gray-600',
                    'hover:border-gray-300');
            });

            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });

            // Add active class to clicked tab
            this.classList.add('font-bold', 'text-purple-700', 'border-purple-700');
            this.classList.remove('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300');

            // Show content of clicked tab
            const activeTab = this.getAttribute('data-tab');
            document.getElementById(activeTab).classList.remove('hidden');
        });
    });
</script>