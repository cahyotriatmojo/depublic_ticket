<style>
    input[type="checkbox"].rounded-full {
        width: 1.2rem;
        /* Adjust size */
        height: 1.2rem;
        /* Adjust size */
        border-radius: 9999px;
        /* Fully rounded */
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
<x-user-layout backgroundColor="bg-white">
    <div class="grid gap-4 xl:grid-cols-1 2xl:grid-cols-3">
        <h1 class="text-xl font-bold text-gray-900 sm:text-2xl my-3 p-2 sm:p-6">Your Orders</h1>
        <div class="flex justify-center">
            <div class="text-sm text-center text-gray-500 border-b border-gray-200">
                <ul class="flex flex-wrap -mb-px justify-center flex-nowrap overflow-x-auto">
                    <li class="mr-2">
                        <a href="#"
                            class="tab-link inline-block p-4 border-b-2 font-bold text-purple-700 border-purple-700 rounded-t-lg"
                            data-tab="wait">Waiting For Payment</a>
                    </li>
                    <li class="mr-2">
                        <a href="#"
                            class="tab-link inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300"
                            data-tab="completed">Completed</a>
                    </li>
                    <li class="mr-2">
                        <a href="#"
                            class="tab-link inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300"
                            data-tab="canceled">Canceled</a>
                    </li>
                </ul>
            </div>
        </div>

        <div id="wait" class="grid gap-4 xl:grid-cols-1 2xl:grid-cols-3 tab-content relative">
            <div class="p-4 bg-white 2xl:col-span-2 dark:border-gray-700 sm:p-6 mb-2">
                @forelse ($payments as $payment)
                    <div id="accordion-collapse" data-accordion="collapse" class="border-2 rounded-xl mb-3">
                        <h2 id="accordion-collapse-heading-1">
                            <button type="button"
                                class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"
                                data-accordion-target="#accordion-collapse-body-{{ $payment->id }}"
                                aria-expanded="true" aria-controls="accordion-collapse-body-{{ $payment->id }}">
                                <p class="text-sm" id="order-id">Order ID: {{ $payment->order_id }}</p>
                                <div class="flex space-x-2 items-center min-h-[40px]">
                                    <a href="{{ route('booking.cancel', $payment->order_id) }}"
                                        class="text-red-600 my-3"
                                        onclick="return confirm('Are you sure you want to cancel this order?')">Cancel
                                        Order</a>
                                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M9 5 5 1 1 5" />
                                    </svg>
                                </div>
                            </button>
                        </h2>
                        <div id="accordion-collapse-body-{{ $payment->id }}" class="hidden"
                            aria-labelledby="accordion-collapse-heading-1">
                            <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                                <div class="flex items-center">
                                    <img src="{{ asset('images/event/ticket.svg') }}"
                                        class="w-6 h-6 text-gray-800 dark:text-white mr-3" alt="Image Description">
                                    <h1 class="text-md text-gray-900 sm:text-2xl">{{ $payment->packages->events->name }}
                                    </h1>
                                </div>
                                <h1 class="text-md font-bold text-gray-900 sm:text-2xl mb-3">IDR
                                    {{ number_format($payment->packages->price * $payment->total, 2, '.', ',') }}</h1>
                                <div class="cta-btn">
                                    <button
                                        class="capitalize w-full rounded-xl px-4 py-2 bg-purple-50 text-purple-500 pay-button"
                                        data-order-id="{{ $payment->snap_token }}"
                                        data-created-at="{{ $payment->created_at }}">Complete Payment in <span
                                            class="countdown">00:00:00</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <h1 class="text-gray-900 sm:text-2xl mb-3">No data</h1>
                @endforelse
                <div class="pagination-links m-4">
                    {{ $payments->appends(['completed_page' => $payments_complete->currentPage(), 'failed_page' => $payments_failed->currentPage(), 'active_tab' => 'wait'])->links() }}
                </div>
            </div>
        </div>

        <div id="completed" class="grid gap-4 xl:grid-cols-1 2xl:grid-cols-3 tab-content hidden relative">
            <div class="p-4 bg-white 2xl:col-span-2 dark:border-gray-700 sm:p-6 mb-5">
                @forelse($payments_complete as $payment)
                    <div id="accordion-collapse" data-accordion="collapse" class="border-2 rounded-xl mb-3">
                        <h2 id="accordion-collapse-heading-1">
                            <button type="button"
                                class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"
                                data-accordion-target="#accordion-collapse-body-{{ $payment->id }}"
                                aria-expanded="true" aria-controls="accordion-collapse-body-{{ $payment->id }}">
                                <p class="text-sm" id="order-id">Order ID: {{ $payment->order_id }}</p>
                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h2>
                        <div id="accordion-collapse-body-{{ $payment->id }}" class="hidden"
                            aria-labelledby="accordion-collapse-heading-1">
                            <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                                <div class="flex items-center">
                                    <img src="{{ asset('images/event/ticket.svg') }}"
                                        class="w-6 h-6 text-gray-800 dark:text-white mr-3" alt="Image Description">
                                    <h1 class="text-md text-gray-900 sm:text-2xl">
                                        {{ $payment->packages->events->name }}
                                    </h1>
                                </div>
                                <h1 class="text-md font-bold text-gray-900 sm:text-2xl mb-3">IDR
                                    {{ number_format($payment->packages->price * $payment->total, 2, '.', ',') }}</h1>
                                <div class="modal-btn">
                                    <button
                                        class="capitalize w-full rounded-xl px-4 py-2 bg-green-50 text-green-500">Completed</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <h1 class="text-gray-900 sm:text-2xl mb-3">No data</h1>
                @endforelse
                <div class="pagination-links m-4">
                    {{ $payments_complete->appends(['failed_page' => $payments_failed->currentPage(), 'wait_page' => $payments->currentPage(), 'active_tab' => 'completed'])->links() }}
                </div>
            </div>
        </div>

        <div id="canceled" class="grid gap-4 xl:grid-cols-1 2xl:grid-cols-3 tab-content hidden relative">
            <div class="p-4 bg-white 2xl:col-span-2 dark:border-gray-700 sm:p-6 mb-5">
                @forelse($payments_failed as $payment)
                    <div id="accordion-collapse" data-accordion="collapse" class="border-2 rounded-xl mb-3">
                        <h2 id="accordion-collapse-heading-1">
                            <button type="button"
                                class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"
                                data-accordion-target="#accordion-collapse-body-{{ $payment->id }}"
                                aria-expanded="true" aria-controls="accordion-collapse-body-{{ $payment->id }}">
                                <p class="text-sm" id="order-id">Order ID: {{ $payment->order_id }}</p>
                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h2>
                        <div id="accordion-collapse-body-{{ $payment->id }}" class="hidden"
                            aria-labelledby="accordion-collapse-heading-1">
                            <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                                <div class="flex items-center">
                                    <img src="{{ asset('images/event/ticket.svg') }}"
                                        class="w-6 h-6 text-gray-800 dark:text-white mr-3" alt="Image Description">
                                    <h1 class="text-md text-gray-900 sm:text-2xl">
                                        {{ $payment->packages->events->name }}
                                    </h1>
                                </div>
                                <h1 class="text-md font-bold text-gray-900 sm:text-2xl mb-3">IDR
                                    {{ number_format($payment->packages->price * $payment->total, 2, '.', ',') }}</h1>
                                <div class="modal-btn">
                                    <button class="capitalize w-full rounded-xl px-4 py-2 bg-red-50 text-red-500"
                                        data-id="{{ $payment->id }}">Canceled</span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <h1 class="text-gray-900 sm:text-2xl mb-3">No data</h1>
                @endforelse
                <div class="pagination-links m-4">
                    {{ $payments_failed->appends(['completed_page' => $payments_complete->currentPage(), 'wait_page' => $payments->currentPage(), 'active_tab' => 'canceled'])->links() }}
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6">
        <div class="flex items-center justify-between my-5">
            <h1 class="text-xl font-bold text-gray-900 sm:text-2xl">Upcoming Event</h1>
            <div class="flex space-x-2">
                <button id="prev-button" class="focus:outline-none">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m15 19-7-7 7-7" />
                    </svg>
                </button>
                <button id="next-button" class="focus:outline-none">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m9 5 7 7-7 7" />
                    </svg>
                </button>
                <a href="{{ route('event') }}" class="text-purple-600">See All</a>
            </div>
        </div>

        <div id="splide" class="splide mb-3">
            <div class="splide__track">
                <ul class="splide__list">
                    @forelse ($events as $item)
                        <li
                            class="splide__slide max-w-sm bg-white border border-gray-200 rounded-lg shadow mx-auto h-full flex flex-col">
                            <a href="{{ route('ticket.detail-event', ['slug' => $item->slug]) }}">
                                <img class="rounded-t-lg w-full h-64 object-cover"
                                    src="{{ asset('public/product/' . $item->image) }}" alt="{{ $item->name }}" />
                            </a>
                            <div class="p-5 flex flex-col justify-between flex-grow h-full">
                                <div>
                                    <div class="flex flex-wrap items-center justify-between my-3">
                                        <div class="flex space-x-2 items-center min-h-[40px]">
                                            <!-- Adjust min-h as needed -->
                                            <svg class="w-4 h-4 sm:w-6 sm:h-6 text-gray-500" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M17.8 13.938h-.011a7 7 0 1 0-11.464.144h-.016l.14.171c.1.127.2.251.3.371L12 21l5.13-6.248c.194-.209.374-.429.54-.659l.13-.155Z" />
                                            </svg>
                                            <h6 class="text-xs sm:text-sm md:text-md text-gray-900">
                                                {{ $item->city }}
                                            </h6>
                                        </div>
                                        <h6 class="text-xs sm:text-sm md:text-md text-purple-500">|
                                            {{ \Carbon\Carbon::parse($item->start_date)->translatedFormat('l, d/m/Y') }}
                                        </h6>
                                    </div>
                                    <a href="#">
                                        <h5
                                            class="mb-2 text-sm sm:text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                                            {{ $item->name }}
                                        </h5>
                                    </a>
                                    <p
                                        class="mb-3 font-normal text-justify text-sm text-gray-400 h-16 overflow-hidden text-ellipsis min-h-[40px]">
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
                                            <a href="{{ route('ticket.detail-event', ['slug' => $item->slug]) }}"
                                                class="capitalize w-full inline-block text-center rounded-xl px-4 py-2 bg-[#EAF2E2] text-[#0B640D]">tersedia</a>
                                        @else
                                            <button
                                                class="capitalize w-full rounded-xl px-4 py-2 bg-red-500 text-red-700"
                                                disabled>Habis</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li
                            class="splide__slide max-w-sm bg-white border border-gray-200 rounded-lg shadow mx-auto h-full flex flex-col items-center justify-center">
                            <p class="text-lg font-semibold text-gray-500">No upcoming events</p>
                        </li>
                    @endforelse
                    <!-- Additional slides here -->
                </ul>
            </div>
        </div>
    </div>
</x-user-layout>
<!-- Modal HTML -->
<div id="orderModal" class="fixed inset-0 hidden items-center justify-center bg-gray-900 bg-opacity-50 flex">
    <div class="bg-white dark:bg-gray-800 rounded-lg p-6 w-96">
        <h2 class="text-xl font-bold mb-4">Order Details</h2>
        <div id="orderDetails">
            <!-- Order details will be populated here -->
        </div>
        <button id="closeModal" class="mt-4 w-full px-4 py-2 bg-red-500 text-white rounded-lg">Close</button>
    </div>
</div>


<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
</script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize countdown timers
        document.querySelectorAll('.pay-button').forEach(function(button) {
            const createdAt = new Date(button.dataset.createdAt);
            const countdownSpan = button.querySelector('.countdown');

            function updateCountdown() {
                const now = new Date();
                const diff = Math.max(0, 24 * 60 * 60 * 1000 - (now - createdAt));
                const hours = Math.floor(diff / (1000 * 60 * 60));
                const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((diff % (1000 * 60)) / 1000);
                countdownSpan.textContent =
                    `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
                if (diff > 0) {
                    requestAnimationFrame(updateCountdown);
                }
            }
            updateCountdown();
        });

        // Handle pay button click
        document.addEventListener('click', function(event) {
            if (event.target.matches('.pay-button')) {
                var orderId = event.target.dataset.orderId;
                snap.pay(orderId, {
                    onSuccess: function(result) {
                        updateStatus(result);
                        document.getElementById('result-json').innerHTML += JSON.stringify(
                            result, null, 2);
                        snap.hide();
                        //window.close(); // Remove this line
                    },
                    onPending: function(result) {
                        updateStatus(result);
                        document.getElementById('result-json').innerHTML += JSON.stringify(
                            result, null, 2);
                        snap.hide();
                        //window.close(); // Remove this line
                    },
                    onError: function(result) {
                        updateStatus(result);
                        document.getElementById('result-json').innerHTML += JSON.stringify(
                            result, null, 2);
                        snap.hide();
                        //window.close(); // Remove this line
                    },
                    onClose: function() {
                        snap.hide();
                        //window.close(); // Remove this line
                    }
                });
            }
        });


        const tabLinks = document.querySelectorAll('.tab-link');
        const tabContents = document.querySelectorAll('.tab-content');

        function setActiveTab(tabName) {
            // Remove active class from all tabs
            tabLinks.forEach(link => {
                link.classList.remove('font-bold', 'text-purple-700', 'border-purple-700');
                link.classList.add('border-transparent', 'hover:text-gray-600',
                    'hover:border-gray-300');
            });

            // Hide all tab contents
            tabContents.forEach(content => {
                content.classList.add('hidden');
            });

            // Add active class to the selected tab
            const activeLink = document.querySelector(`[data-tab="${tabName}"]`);
            if (activeLink) {
                activeLink.classList.add('font-bold', 'text-purple-700', 'border-purple-700');
                activeLink.classList.remove('border-transparent', 'hover:text-gray-600',
                    'hover:border-gray-300');

                // Show content of the selected tab
                const activeContent = document.getElementById(tabName);
                if (activeContent) {
                    activeContent.classList.remove('hidden');
                }
            }
        }

        tabLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const activeTab = this.getAttribute('data-tab');
                setActiveTab(activeTab);

                // Update the URL without reloading the page
                const urlParams = new URLSearchParams(window.location.search);
                urlParams.set('active_tab', activeTab);
                history.replaceState(null, '', '?' + urlParams.toString());
            });
        });

        // On page load, check for active_tab parameter and set the active tab
        const urlParams = new URLSearchParams(window.location.search);
        const activeTab = urlParams.get('active_tab') || 'wait';
        setActiveTab(activeTab);

        const modal = document.getElementById('orderModal');
        const orderDetails = document.getElementById('orderDetails');
        const closeModal = document.getElementById('closeModal');

        // Handle click on "Completed" buttons
        document.querySelectorAll('.modal-btn button').forEach(button => {
            button.addEventListener('click', function() {
                const paymentId = this.closest('[id^="accordion-collapse-body-"]').id.split('-')
                    .pop();
                // Fetch order details using the paymentId
                fetchOrderDetails(paymentId);
            });
        });

        // Fetch order details from backend
        function fetchOrderDetails(paymentId) {
            fetch(`/payment/${paymentId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                        return;
                    }

                    // Populate modal with order details
                    orderDetails.innerHTML = `
                        <div class="flex justify-between">
                            <p><strong>Event Name:</strong></p>
                            <p>${data.packages.events.name}</p>
                        </div>
                        <div class="flex justify-between">
                            <p><strong>Package:</strong></p>
                            <p>${data.packages.name}</p>
                        </div>
                        <div class="flex justify-between">
                            <p><strong>Total:</strong></p>
                            <p>${data.total}</p>
                        </div>
                        <div class="flex justify-between">
                            <p><strong>Date:</strong></p>
                            <p>${formatDate(data.date)}</p>
                        </div>
                        <div class="flex justify-between">
                            <p><strong>Price:</strong></p>
                            <p>IDR ${data.packages.price.toLocaleString('id-ID')}</p>
                        </div>
                        <div class="flex justify-between">
                            <p><strong>Total Price:</strong></p>
                            <p>IDR ${(data.packages.price * data.total).toLocaleString('id-ID')}</p>
                        </div>
                        <div class="flex justify-between">
                            <p><strong>Status:</strong></p>
                            <p>${data.status}</p>
                        </div>
                        <!-- Add other details here -->
                    `;

                    // Show the modal
                    modal.classList.remove('hidden');
                })
                .catch(error => {
                    console.error('Error fetching order details:', error);
                    alert('Failed to fetch order details.');
                });
        }
        // Handle close modal
        closeModal.addEventListener('click', function() {
            modal.classList.add('hidden');
        });
    });

    function formatDate(dateString) {
        const date = new Date(dateString);
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0'); // Months are 0-based
        const year = date.getFullYear();
        return `${day}/${month}/${year}`;
    }

    function updateStatus(result) {
        fetch(`/update-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(result)
            })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var splide = new Splide('#splide', {
            perPage: 1, // Display 1 slide per page
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
</script>
