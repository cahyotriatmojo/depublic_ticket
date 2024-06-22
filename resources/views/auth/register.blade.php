<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Get started with a free and open-source admin dashboard layout built with Tailwind CSS and Flowbite featuring charts, widgets, CRUD layouts, authentication pages, and more">
    <meta name="author" content="Themesberg">
    <meta name="generator" content="Hugo 0.58.2">

    <title>Depublic</title>

    <link rel="canonical" href="https://flowbite-admin-dashboard.vercel.app/layouts/stacked/">



    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://flowbite-admin-dashboard.vercel.app//app.css">
    <link rel="apple-touch-icon" sizes="180x180"
        href="https://flowbite-admin-dashboard.vercel.app/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32"
        href="https://flowbite-admin-dashboard.vercel.app/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16"
        href="https://flowbite-admin-dashboard.vercel.app/favicon-16x16.png">
    <link rel="icon" type="image/png" href="https://flowbite-admin-dashboard.vercel.app/favicon.ico">
    <link rel="manifest" href="https://flowbite-admin-dashboard.vercel.app/site.webmanifest">
    <link rel="mask-icon" href="https://flowbite-admin-dashboard.vercel.app/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide/dist/css/splide.min.css">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    @vite('resources/css/app.css')
</head>

<body class="bg-white overflow-x-hidden">
    <header>
        <nav
            class="fixed z-30 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 py-3 px-4 shadow-sm">
            <div class="flex justify-between items-center max-w-screen-2xl mx-auto">
                <div class="flex justify-start items-center">
                    <a href="{{ route('home') }}" class="flex mr-14">
                        <img src="{{ asset('images/logo/logo.svg') }}" class="mr-3 h-10" alt="FlowBite Logo" />
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <div class="flex flex-col min-h-screen pt-16 overflow-hidden bg-white dark:bg-gray-100">
        <div class="bg-surface-900 flex justify-between items-center border-b">
            <h1 class="text-l font-bold m-3">Sign Up</h1>
            <a href="{{ route('home') }}" class="mx-3">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18 17.94 6M18 18 6.06 6" />
                </svg>
                <span class="sr-only">Icon description</span>
            </a>
        </div>
        <div id="main-content" class="relative flex-grow w-full max-w-screen-2xl mx-auto h-full overflow-y-auto bg-white dark:bg-gray-900 overflow-x-hidden">
            <main class="flex items-center justify-center min-h-screen relative bg-no-repeat bg-right-top overflow-hidden" style="background-image: url('{{ asset('images/banner/bg-2.png') }}'); background-size: 150px;">
                <div class=" p-8 w-full max-w-2xl mx-auto border-b-[8px] border-gray-200" >
                    <div class="px-4 2xl:px-0" >
                        <!-- Main widget -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />
                        <h1 class="text-lg font-semibold">Register for the better experience</h1>
        
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="name" id="name"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " required value="{{ old('name') }}" />
                                <label for="name"
                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Name</label>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="email" name="email" id="floating_email"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " required value="{{ old('email') }}" />
                                <label for="floating_email"
                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email
                                    address</label>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="password" name="password" id="floating_password"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " required />
                                <label for="floating_password"
                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " required />
                                <label for="password_confirmation"
                                    class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Confirm Password</label>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="flex items-center justify-center w-full text-white bg-purple-500 hover:bg-purple-700 focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Sign In</button>
                                <div class="flex items-center justify-center">
                                    <h1 class="text-md font-light text-gray-500 mr-3 justify-center flex">have an account?</h1>
                                    <a href="{{ route('login') }}" class="text-purple-500 font-bold text-md">Login</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
            <h1 class="text-l font-semibold text-gray-500 m-3 justify-center flex">atau daftar dengan</h1>
            <div class="w-full flex justify-center mx-2 mb-20">
                <a href="auth/redirect" class="text-white bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-full text-lg p-4 text-center inline-flex items-center me-2">
                    <img src="{{ asset('images/logo/google.png') }}" alt="Icon description" class="w-10 h-10" />
                    <span class="sr-only">Icon description</span>
                </a>
            </div>
        </div>        
    </div>


    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide/dist/js/splide.min.js"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://flowbite-admin-dashboard.vercel.app//app.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.2/datepicker.min.js"></script>
</body>

</html>

