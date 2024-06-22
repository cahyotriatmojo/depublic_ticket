<!--Nav-->
<nav aria-label="menu nav" class="bg-gray-900 pt-2 md:pt-1 pb-1 px-1 mt-0 h-auto fixed w-full z-20 top-0">
    <div class="flex items-center justify-between">
        <!-- Logo -->
        <div class="flex items-center">
            <a href="#" aria-label="Home">
                <img src="{{ asset('images/logo/logo.svg') }}" class="mr-3 h-10" alt="FlowBite Logo" />
            </a>
        </div>

        <!-- Dropdown Menu -->
        <div class="relative">
            <button onclick="toggleDD('myDropdown')" class="drop-button text-white py-2 px-2 flex items-center">
                <span class="pr-2"><i class="em em-robot_face"></i></span> Hi, {{ auth()->user()->name }}
                <svg class="h-3 fill-current inline ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
            </button>
            <div id="myDropdown" class="dropdownlist absolute bg-gray-800 text-white right-0 mt-3 p-3 overflow-auto z-30 invisible">
                <a href="{{ route('profile.edit') }}" class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block">
                    <i class="fa fa-user fa-fw"></i> Profile
                </a>
                <div class="border border-gray-800"></div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block">
                        <i class="fas fa-sign-out-alt fa-fw"></i> Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
