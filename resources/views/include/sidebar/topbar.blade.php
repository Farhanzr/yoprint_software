<header class="py-2 bg-white bg-center bg-cover" style="background-image: url('{{asset('img/header.jpg')}}');">
    <div class="flex items-center justify-between px-6 mx-auto">
        <div class="flex items-center space-x-2 ">
            <!-- Mobile hamburger -->
            <button class="p-1 -ml-1 bg-gray-100 rounded-md shadow-lg md:hidden focus:outline-none "
                @click="toggleSideMenu" aria-label="Menu">
                {{-- <x-heroicon-o-menu class="w-6 h-6 text-teal-600" /> --}}
                <i class="fa-solid fa-angles-right text-teal-600"></i>
            </button>

            <!-- Desktop hamburger -->
            <div class="hidden md:block" >
                <div class="flex justify-center ">
                    <button class="p-2 -ml-1 bg-gray-100 rounded-md shadow-lg focus:outline-none"
                        @click="toggleSideMenuDesktop" aria-label="Menu">
                        <i class="fa-solid fa-angles-left text-teal-600" x-show="isSideMenuOpenDesktop"  x-cloak></i>
                        <i class="fa-solid fa-angles-right text-teal-600" x-show="!isSideMenuOpenDesktop"  x-cloak></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>
