-<style>
    input[type="checkbox"].rounded-full {
        width: 1.2rem;
        /* Adjust size */
        height: 1.2rem;
        /* Adjust size */
        border-radius: 9999px;
        /* Fully rounded */
    }
</style>
<x-user-layout backgroundColor="bg-white">
    <x-slot name="slot3">
        <div class="bg-surface-900 p-4 flex items-center border-b">
            <a href="{{ route('booking.index', $package->id) }}" class="mx-3">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m15 19-7-7 7-7" />
                </svg>
                <span class="sr-only">Icon description</span>
            </a>
            <h1 class="text-xl font-semibold my-3">Ticket Package</h1>
        </div>
    </x-slot>
    <form action="{{ route('booking.storeDetail', $package->id) }}" method="POST">
        @csrf
        <div class="grid gap-4 xl:grid-cols-1 2xl:grid-cols-3">
            <div class="p-4 shadow-md bg-white 2xl:col-span-2 dark:border-gray-700 sm:p-6 mb-5">
                <h1 class="text-xl font-bold text-gray-900 sm:text-2xl mb-3">Your Contact</h1>
                <p class="text-sm text-gray-500 mb-2">Fill in this form correctly. We'll send the e-ticket to the email
                    address as declared on this page.</p>
                <div class="my-5">
                    <!-- YOUR CONTACT -->
                    <input type="text" id="contact_name" name="contact_name"
                        class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-purple-300 focus:border-purple-300 mb-5"
                        placeholder="Full name" required />
                    <div class="flex mb-5">
                        <span
                            class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 480">
                                <g fill-rule="evenodd" stroke-width="1pt">
                                    <path fill="#fff" d="M0 0h640v480H0z" />
                                    <path fill="#e70011" d="M0 0h640v240H0z" />
                                </g>
                            </svg>
                        </span>
                        <input type="tel" id="contact_phone_number" name="contact_phone"
                            class="block w-full p-4 rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5"
                            placeholder="Phone Number">
                    </div>
                    <input type="email" id="contact_email" name="contact_email"
                        class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-purple-300 focus:border-purple-300 mb-5"
                        placeholder="Email" required />
                </div>
            </div>
        </div>

        <div class="grid gap-4 xl:grid-cols-1 2xl:grid-cols-3">
            <div class="p-4 shadow-md bg-white 2xl:col-span-2 dark:border-gray-700 sm:p-6">
                <h1 class="text-xl font-bold text-gray-900 sm:text-2xl mb-3">Visitor Details</h1>
                <p class="text-sm text-gray-500 mb-2">Make sure to fill in the visitor details correctly for a smooth
                    experience.</p>
                <!-- VISITOR DETAILS -->
                <div class="my-5">
                    <div class="flex items-center mb-4">
                        <input type="checkbox" name="visitor_detail" id="visitor_detail" value="same"
                            class="rounded-full w-4 h-4 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring-purple-500 focus:ring-2">
                        <label for="visitor_detail" class="block ms-2 text-md font-medium text-gray-400">
                            Same as contact details
                        </label>
                    </div>
                    <hr class="border-gray-300 mb-4">
                    <div class="flex items-center p-2 mb-4 text-sm text-yellow-800 rounded-full bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300"
                        role="alert">
                        <svg class="w-6 h-6 text-yellow-400 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="mx-3 text-yellow-400">
                            You only need one visitor's info for all the tickets you book
                        </div>
                    </div>
                    <input type="text" id="visitor_name" name="visitor_name"
                        class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-purple-300 focus:border-purple-300 mb-5"
                        placeholder="Full name" required />
                    <div class="flex mb-5">
                        <span
                            class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 480">
                                <g fill-rule="evenodd" stroke-width="1pt">
                                    <path fill="#fff" d="M0 0h640v480H0z" />
                                    <path fill="#e70011" d="M0 0h640v240H0z" />
                                </g>
                            </svg>
                        </span>

                        <input type="tel" id="visitor_phone_number" name="visitor_phone"
                            class="block w-full p-4 rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5"
                            placeholder="Phone Number">
                    </div>
                    <input type="email" id="visitor_email" name="visitor_email"
                        class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-purple-300 focus:border-purple-300 mb-5"
                        placeholder="Email" required />
                </div>
            </div>
        </div>
        <div class="p-4 bg-white rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <div class="p-5 flex justify-between items-center">
                <span class="text-lg font-bold">Total Payment</span>
                <span class="text-lg font-bold text-purple-700">IDR
                    {{ number_format(session('order_total') * session('order_price'), 0, ',', '.') }}</span>
            </div>
            <hr class="border-gray-300 mb-10">
        </div>
        <button type="submit" class="w-full bg-purple-500 hover:bg-purple-700 text-white font-bold p-4">
            Book Ticket
        </button>
    </form>
</x-user-layout>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const contactName = document.getElementById('contact_name');
        const contactPhoneNumber = document.getElementById('contact_phone_number');
        const contactEmail = document.getElementById('contact_email');

        const visitorName = document.getElementById('visitor_name');
        const visitorPhoneNumber = document.getElementById('visitor_phone_number');
        const visitorEmail = document.getElementById('visitor_email');

        const visitorDetailCheckbox = document.getElementById('visitor_detail');

        // Function to synchronize visitor details with contact details
        const syncVisitorDetails = () => {
            if (visitorDetailCheckbox.checked) {
                visitorName.value = contactName.value;
                visitorPhoneNumber.value = contactPhoneNumber.value;
                visitorEmail.value = contactEmail.value;
            }
        };

        // Event listeners for contact details
        contactName.addEventListener('input', syncVisitorDetails);
        contactPhoneNumber.addEventListener('input', syncVisitorDetails);
        contactEmail.addEventListener('input', syncVisitorDetails);

        // Event listener for visitor details
        visitorName.addEventListener('input', () => {
            if (visitorDetailCheckbox.checked) {
                visitorDetailCheckbox.checked = false;
            }
        });

        visitorPhoneNumber.addEventListener('input', () => {
            if (visitorDetailCheckbox.checked) {
                visitorDetailCheckbox.checked = false;
            }
        });

        visitorEmail.addEventListener('input', () => {
            if (visitorDetailCheckbox.checked) {
                visitorDetailCheckbox.checked = false;
            }
        });

        // Event listener for the checkbox
        visitorDetailCheckbox.addEventListener('change', () => {
            if (visitorDetailCheckbox.checked) {
                syncVisitorDetails();
            }
        });
    });
</script>

