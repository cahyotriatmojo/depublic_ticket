<x-user-layout>
    <!-- Main Content -->
    <x-slot name="slot3">
        <div class="relative bg-cover bg-no-repeat bg-surface-500" style="background-image: url('{{ asset('images/banner/bg.png') }}'); background-position: right; background-size: contain;">
            <div class="flex flex-col md:flex-row justify-between items-center my-5 w-full">
                <form class="w-full px-3 py-5" id="search-form">
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white bg-opacity-50 focus:ring-purple-500 placeholder-gray-500" placeholder="Search" />
                        <div id="dropdown" class="absolute w-full bg-white border border-gray-300 rounded-lg shadow-md mt-1 hidden z-50">
                            <ul id="results" class="py-1">
                                <!-- Results will be appended here -->
                            </ul>
                        </div>
                    </div>
                </form>

            </div>
            <div class="justify-start md:justify-between items-start md:items-center px-5 mb-5 w-full">
                <h1 class="text-3xl font-semibold mb-1">Depublic Event</h1>
                <h1 class="text-3xl font-semibold mb-6">Application</h1>
                <a href="{{ route('event') }}" class="bg-purple-500 text-white px-4 py-2 rounded-md">All Events</a>
            </div>

            <!-- Event Banner Carousel -->
            <div class="swiper-container max-w-full overflow-hidden relative">
                <div class="swiper-wrapper">
                    @foreach ($banners as $banner)
                    <div class="swiper-slide">
                        <a href="{{ route('ticket.detail-event', ['slug' => $banner->slug]) }}">
                            <img src="{{ asset('public/product/'.$banner->image) }}" alt="Event Banner" class="w-full h-100 md:h-128 object-cover rounded-md mb-4">
                        </a>
                    </div>
                    @endforeach
                </div>                
                <!-- Add Pagination -->
                <div class="swiper-pagination absolute bottom-0 left-0 w-full text-center"></div>
            </div>
        </div>
    </x-slot>
    <!-- Upcoming Events -->
    <div class="mt-6">
        <div class="flex items-center justify-between my-5">
            <h1 class="text-xl font-bold text-gray-900 sm:text-2xl">Upcoming Event</h1>
            <div class="flex space-x-2">
                <button id="prev-button" class="focus:outline-none">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7" />
                    </svg>
                </button>
                <button id="next-button" class="focus:outline-none">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
                    </svg>
                </button>
                <a href="{{ route('event') }}" class="text-purple-600">See All</a>
            </div>
        </div>

        <div id="splide" class="splide mb-3">
            <div class="splide__track">
                <ul class="splide__list">
                    @forelse ($events as $item)
                    <li class="splide__slide max-w-sm bg-white border border-gray-200 rounded-lg shadow mx-auto h-full flex flex-col">
                        <a href="{{ route('ticket.detail-event', ['slug' => $item->slug]) }}">
                            <img class="rounded-t-lg w-full h-64 object-cover" src="{{ asset('public/product/'.$item->image) }}" alt="{{ $item->name }}" />
                        </a>
                        <div class="p-5 flex flex-col justify-between flex-grow h-full">
                            <div>
                                <div class="flex flex-wrap items-center justify-between my-3">
                                    <div class="flex space-x-2 items-center min-h-[40px]">
                                        <!-- Adjust min-h as needed -->
                                        <svg class="w-4 h-4 sm:w-6 sm:h-6 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.8 13.938h-.011a7 7 0 1 0-11.464.144h-.016l.14.171c.1.127.2.251.3.371L12 21l5.13-6.248c.194-.209.374-.429.54-.659l.13-.155Z" />
                                        </svg>
                                        <h6 class="text-xs sm:text-sm md:text-md text-gray-900">{{ $item->city }}
                                        </h6>
                                    </div>
                                    <h6 class="text-xs sm:text-sm md:text-md text-purple-500">|
                                        {{ \Carbon\Carbon::parse($item->start_date)->translatedFormat('l, d/m/Y') }}
                                    </h6>
                                </div>
                                <a href="#">
                                    <h5 class="mb-2 text-sm sm:text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        {{ $item->name }}
                                    </h5>
                                </a>
                                <p class="mb-3 font-normal text-justify text-sm text-gray-400 h-16 overflow-hidden text-ellipsis min-h-[40px]">
                                    {{ $item->truncatedDescription }}
                                </p>
                            </div>
                            <div>
                                <div class="flex my-3">
                                    <p class="text-lg font-bold text-purple-500">IDR
                                        {{ number_format($item->cheapestPackage->price, 0, ',', '.') }}
                                    </p>
                                    <span class="text-md text-gray-700">/1 Person</span>
                                </div>
                                <div class="cta-btn">
                                    @if ($item->hasQuota)
                                        <a href="{{ route('ticket.detail-event', ['slug' => $item->slug]) }}" class="capitalize w-full inline-block text-center rounded-xl px-4 py-2 bg-[#EAF2E2] text-[#0B640D]">tersedia</a>
                                    @else
                                        <button class="capitalize w-full rounded-xl px-4 py-2 bg-red-500 text-red-700" disabled>Habis</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </li>
                    @empty
                        <li class="splide__slide max-w-sm bg-white border border-gray-200 rounded-lg shadow mx-auto h-full flex flex-col items-center justify-center">
                            <p class="text-lg font-semibold text-gray-500">No upcoming events</p>
                        </li>
                    @endforelse
                    <!-- Additional slides here -->
                </ul>
            </div>
        </div>
    </div>
</x-user-layout>
<script>
    var swiper = new Swiper('.swiper-container', {
        slidesPerView: 1.5,
        spaceBetween: 20,
        centeredSlides: true,
        initialSlide: 1,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        autoplay: {
            delay: 5000, // 5000 ms = 5 detik
            disableOnInteraction: false,
        },
    });

    document.addEventListener('DOMContentLoaded', function() {
        var splide = new Splide('#splide', {
            type: 'slide',
            perPage: 1, // Display 1 slide per page
            perMove: 1,
            gap: '20px', // Gap between slides
            pagination: false,
            arrows: false,
            breakpoints: {
                640: {
                    perPage: 1, // Display 1 slide per page for small screens
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

    document.getElementById('default-search').addEventListener('input', function() {
        const query = this.value;
        if (query.length > 1) {
            fetch(`/search-events?q=${query}`)
                .then(response => response.json())
                .then(data => {
                    const dropdown = document.getElementById('dropdown');
                    const results = document.getElementById('results');
                    results.innerHTML = ''; // Clear previous results

                    if (data.length > 0) {
                        data.forEach(event => {
                            const li = document.createElement('li');
                            li.classList.add('px-4', 'py-2', 'cursor-pointer', 'hover:bg-gray-200',
                                'flex', 'items-center');

                            const anchor = document.createElement('a');
                            anchor.href = '/ticket/' + event.slug;

                            anchor.classList.add('flex', 'items-center', 'w-full');

                            const img = document.createElement('img');
                            img.src = `{{ asset('public/product/') }}/${event.image}`;
                            img.alt = event.name;
                            img.classList.add('w-10', 'h-10', 'mr-3');

                            const text = document.createElement('span');
                            text.textContent = event.name;

                            anchor.appendChild(img);
                            anchor.appendChild(text);
                            li.appendChild(anchor);
                            results.appendChild(li);
                        });
                    } else {
                        results.innerHTML = '<li class="px-4 py-2 text-gray-500">Data not found</li>';
                    }

                    dropdown.classList.remove('hidden');
                });
        } else {
            document.getElementById('dropdown').classList.add('hidden');
        }
    });
</script>