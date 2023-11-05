    <!-- Mobile sidebar -->
    <!-- Backdrop -->
    <div
    x-cloak
    x-show="isSideMenuOpen"
    x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
    ></div>

    <aside
    x-cloak
    class="fixed inset-y-0 z-20 flex-shrink-0 w-64 overflow-y-auto bg-teal-600 dark:bg-gray-800 md:hidden"
    x-show="isSideMenuOpen"
    x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0 transform -translate-x-20"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0 transform -translate-x-20"
    @click.away="closeSideMenu"
    @keydown.escape="closeSideMenu"
    >


    <div class="mb-6 animate">
        <div class="text-white">
            <div class="p-2 mx-2 my-2 bg-gray-200 rounded-md">
                <div class="flex justify-center ">
                    <img src="{{asset('img/power_button.png')}}" class="w-16 h-16"  /> 
                </div>
            </div>
            <div>
                <ul class="mt-6 leading-10">
                    <x-sidebar.nav-item title="DASHBOARD" route="{{route('home')}}" uri="home">
                        <i class="fa-solid fa-house"></i>
                    </x-sidebar.nav-item>

                    <x-sidebar.nav-item title="FILE UPLOAD" route="{{ route('upload') }}" uri="upload">
                        <i class="fa-solid fa-file-arrow-up"></i>
                    </x-sidebar.nav-item>
                </ul>
            </div>
        </div>
    </div>

    </aside>
