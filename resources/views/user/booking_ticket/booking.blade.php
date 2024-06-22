<style>
    /* Hides the up and down arrows in number inputs */
    /* For Chrome, Safari, Edge, Opera */
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* For Firefox */
    input[type="number"] {
        appearance: textfield;
    }
</style>
<x-user-layout backgroundColor="bg-purple-50">
    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('pay.store') }}" enctype="multipart/form-data" method="POST">
        @csrf
        <x-slot name="slot3">
            <div class="bg-gray-50 p-4 flex justify-between items-center border-b">
                <h1 class="text-2xl font-semibold my-3">Book Ticket</h1>
                <a href="{{ route('home') }}" class="text-red-600 my-3">Cancel Order</a>
            </div>
        </x-slot>

        <div class="grid gap-4 xl:grid-cols-1 2xl:grid-cols-1">
            <h1 class="text-xl font-bold text-gray-900 sm:text-2xl dark:text-white">{{ $package->events->name }}</h1>
            <div
                class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800 mb-3">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex-shrink-0">
                        <span
                            class="text-xl font-bold leading-none text-gray-900 sm:text-2xl dark:text-white">{{ $package->name }}</span>
                    </div>
                </div>
                <h1 class="text-l font-bold leading-none text-purple-700 sm:text-2xl dark:text-white">IDR
                    {{ number_format($package->price, 0, ',', '.') }}</h1>
                <input type="hidden" name="package_id" value="{{ $package->id }}">
                <input type="hidden" name="package_price" value="{{ $package->price }}">
            </div>

            <div
                class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800 mb-3">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex-shrink-0">
                        <span
                            class="text-xl font-bold leading-none text-gray-900 sm:text-2xl dark:text-white">Date</span>
                    </div>
                </div>
                <div class="mb-5">
                    <input type="date" name="date" id="date"
                        class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-purple-300 focus:border-purple-300"
                        placeholder="Select Date" min="{{ $package->events->start_date }}"
                        max="{{ $package->events->end_date }}" required />
                </div>
            </div>

            <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 sm:p-6 mb-3">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex-shrink-0">
                        <span
                            class="text-xl font-bold leading-none text-gray-900 sm:text-2xl dark:text-white">Total</span>
                    </div>
                </div>
                <div class="mb-5">
                    <div class="flex justify-between items-center mb-4">
                        <div
                            class="flex items-center w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-purple-300 focus:border-purple-300">
                            <span class="flex-1 text-sm">{{ $package->name }}</span>
                            <span class="flex-none text-sm font-bold text-purple-700">IDR
                                {{ number_format($package->price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex items-center space-x-2 ml-4">
                            <button type="button" id="minus-btn"
                                class="p-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-300 focus:outline-none">-</button>
                            <input type="number" name="total" id="total" value="1"
                                class="block w-12 p-2 text-center text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-purple-300 focus:border-purple-300"
                                readonly>
                            <button type="button" id="plus-btn"
                                class="p-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-300 focus:outline-none">+</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="p-4 bg-white border border-gray-200 shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800 mt-5">
            <div class="flex items-center justify-between mb-4">
                <div class="flex-shrink-0">
                    <span
                        class="text-xl font-bold leading-none text-gray-900 sm:text-2xl dark:text-white">Summary</span>
                </div>
            </div>
            <div class="flex justify-between items-center mb-2">
                <span class="text-mb text-gray-800">Name</span>
                <span class="block text-md font-semibold">{{ auth()->user()->name }}</span>
            </div>
            <div class="flex justify-between items-center mb-2">
                <span class="text-mb text-gray-800">Email</span>
                <span class="block text-md font-semibold">{{ auth()->user()->email }}</span>
            </div>
            <hr class="border-gray-300 mb-4">
            <div class="flex justify-between items-center mb-2">
                <span class="text-mb text-gray-800">Date</span>
                <span class="block text-lg font-bold" id="choosingDate"></span>
            </div>
            <hr class="border-gray-300 mb-4">
            <div class="flex justify-between items-center">
                <span class="text-sm font-semibold">Total (<span id="ticketCount">1</span> Ticket)</span>
                <div class="relative">
                    <span class="absolute left-0 top-1/2 transform -translate-y-1/2 font-bold text-purple-700">IDR
                    </span>
                    <input type="text" name="total_price" id="total_price"
                        value="{{ number_format($package->price, 0, ',', '.') }}"
                        class="text-lg font-bold text-purple-700 border-none text-end p-0 pl-5 w-full" readonly>
                </div>
            </div>
        </div>
        <button type="submit" class="w-full bg-purple-500 hover:bg-purple-700 text-white font-bold p-4">
            Next
        </button>

    </form>
</x-user-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const minusBtn = document.getElementById('minus-btn');
        const plusBtn = document.getElementById('plus-btn');
        const totalInput = document.getElementById('total');
        const totalPrice = document.getElementById('total_price');
        const datePicker = document.getElementById('date');
        const choosingDate = document.getElementById('choosingDate');
        const ticketCount = document.getElementById('ticketCount');

        const formatPrice = (price) => {
            return price.toLocaleString('id-ID');
        };

        minusBtn.addEventListener('click', () => {
            let value = parseInt(totalInput.value);
            if (value > 1) {
                value--;
                totalInput.value = value;
                ticketCount.innerText = value;
                totalPrice.value = formatPrice(value * {{ $package->price }});
            }
        });

        plusBtn.addEventListener('click', () => {
            let value = parseInt(totalInput.value);
            value++;
            totalInput.value = value;
            ticketCount.innerText = value;
            totalPrice.value = formatPrice(value * {{ $package->price }});
        });


        datePicker.addEventListener('change', function() {
            choosingDate.innerText = datePicker.value;
        });
    });
</script>
