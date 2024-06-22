<x-user-layout>
    {{-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <!-- Main Content -->
    <main class="container mx-auto p-5">
        <div class="shadow-md p-6 rounded-md">
            <div class="flex flex-col md:flex-row justify-between items-center mb-5">
                <input type="text" placeholder="Search Activities" class="border border-gray-300 rounded-md px-4 py-2 w-full max-w-xs mb-4 md:mb-0">
            </div>
            <div class="flex flex-col md:flex-row justify-start md:justify-between items-start md:items-center mb-5 w-full">
                <h1 class="text-xl font-bold mb-4 md:mb-0 text-white">Depublic Event Application</h1>
                <a href="{{ route('event') }}" class="bg-purple-600 text-white px-4 py-2 rounded-md">All Events</a>
            </div>

            <!-- Event Banner Carousel -->
            <div class="swiper-container"> <!-- Set max height for the carousel -->
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="{{ asset('images/banner/konsermaherzain.jpg') }}" alt="Event Banner" class="w-full h-50 object-cover rounded-md mb-4">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('images/banner/konsermaherzain.jpg') }}" alt="Event Banner" class="w-full h-full object-cover rounded-md">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('images/banner/konsermaherzain.jpg') }}" alt="Event Banner" class="w-full h-full object-cover rounded-md">
                    </div>
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
            </div>
            <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
            <script>
                var swiper = new Swiper('.swiper-container', {
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                });
            </script>

            <!-- Upcoming Events -->
            <div class="mt-6">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-lg font-bold text-white ">Upcoming Event</span>
                    <a href="{{ route('event') }}" class="text-purple-600">See All</a>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-4">
                    <!-- Event Card -->
                    <div class="bg-white shadow-md rounded-md p-4">
                        <img src="{{ asset('images/banner/konsermaherzain.jpg') }}" alt="Event" class="w-full rounded-md mb-4">
                        <h3 class="text-lg font-semibold">Judul Event</h3>
                        <p class="text-gray-500 mb-2">Bandung | Day, Mon Tanggal</p>
                        <p class="text-purple-600 font-semibold">IDR 1.999.000 / 1 Person</p>
                        <button class="mt-2 bg-green-500 text-white px-4 py-2 rounded-md">Tersedia</button>
                    </div>
                    <!-- Event Card (Duplicate) -->
                    <div class="bg-white shadow-md rounded-md p-4">
                        <img src="{{ asset('images/banner/konsermaherzain.jpg') }}" alt="Event" class="w-full rounded-md mb-4">
                        <h3 class="text-lg font-semibold">Judul Event</h3>
                        <p class="text-gray-500 mb-2">Bandung | Day, Mon Tanggal</p>
                        <p class="text-purple-600 font-semibold">IDR 1.999.000 / 1 Person</p>
                        <button class="mt-2 bg-green-500 text-white px-4 py-2 rounded-md">Tersedia</button>
                    </div>
                    <!-- Event Card (Duplicate) -->
                    <div class="bg-white shadow-md rounded-md p-4">
                        <img src="{{ asset('images/banner/konsermaherzain.jpg') }}" alt="Event" class="w-full rounded-md mb-4">
                        <h3 class="text-lg font-semibold">Judul Event</h3>
                        <p class="text-gray-500 mb-2">Bandung | Day, Mon Tanggal</p>
                        <p class="text-purple-600 font-semibold">IDR 1.999.000 / 1 Person</p>
                        <button class="mt-2 bg-green-500 text-white px-4 py-2 rounded-md">Tersedia</button>
                    </div>
                    <!-- Event Card (Duplicate) -->
                    <div class="bg-white shadow-md rounded-md p-4">
                        <img src="{{ asset('images/banner/konsermaherzain.jpg') }}" alt="Event" class="w-full rounded-md mb-4">
                        <h3 class="text-lg font-semibold">Judul Event</h3>
                        <p class="text-gray-500 mb-2">Bandung | Day, Mon Tanggal</p>
                        <p class="text-purple-600 font-semibold">IDR 1.999.000 / 1 Person</p>
                        <button class="mt-2 bg-green-500 text-white px-4 py-2 rounded-md">Tersedia</button>
                    </div>
                    <!-- Event Card (Duplicate) -->
                    <div class="bg-white shadow-md rounded-md p-4">
                        <img src="{{ asset('images/banner/konsermaherzain.jpg') }}" alt="Event" class="w-full rounded-md mb-4">
                        <h3 class="text-lg font-semibold">Judul Event</h3>
                        <p class="text-gray-500 mb-2">Bandung | Day, Mon Tanggal</p>
                        <p class="text-purple-600 font-semibold">IDR 1.999.000 / 1 Person</p>
                        <button class="mt-2 bg-green-500 text-white px-4 py-2 rounded-md">Tersedia</button>
                    </div>
                    <!-- Event Card (Duplicate) -->
                    <div class="bg-white shadow-md rounded-md p-4">
                        <img src="{{ asset('images/banner/konsermaherzain.jpg') }}" alt="Event" class="w-full rounded-md mb-4">
                        <h3 class="text-lg font-semibold">Judul Event</h3>
                        <p class="text-gray-500 mb-2">Bandung | Day, Mon Tanggal</p>
                        <p class="text-purple-600 font-semibold">IDR 1.999.000 / 1 Person</p>
                        <button class="mt-2 bg-green-500 text-white px-4 py-2 rounded-md">Tersedia</button>
                    </div>
                    <!-- Event Card (Duplicate) -->
                    <div class="bg-white shadow-md rounded-md p-4">
                        <img src="{{ asset('images/banner/konsermaherzain.jpg') }}" alt="Event" class="w-full rounded-md mb-4">
                        <h3 class="text-lg font-semibold">Judul Event</h3>
                        <p class="text-gray-500 mb-2">Bandung | Day, Mon Tanggal</p>
                        <p class="text-purple-600 font-semibold">IDR 1.999.000 / 1 Person</p>
                        <button class="mt-2 bg-green-500 text-white px-4 py-2 rounded-md">Tersedia</button>
                    </div>
                    <!-- Event Card (Duplicate) -->
                    <div class="bg-white shadow-md rounded-md p-4">
                        <img src="{{ asset('images/banner/konsermaherzain.jpg') }}" alt="Event" class="w-full rounded-md mb-4">
                        <h3 class="text-lg font-semibold">Judul Event</h3>
                        <p class="text-gray-500 mb-2">Bandung | Day, Mon Tanggal</p>
                        <p class="text-purple-600 font-semibold">IDR 1.999.000 / 1 Person</p>
                        <button class="mt-2 bg-green-500 text-white px-4 py-2 rounded-md">Tersedia</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-user-layout>