<link rel="stylesheet" href="{{ asset('css/sidebar.css')}}" />

<aside
    x-show="isSideMenuOpenDesktop"
    x-transition:enter="transition ease-in-out duration-300"
    x-transition:enter-start="opacity-0 transform -translate-x-20"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0 transform -translate-x-20"
    @keydown.escape="closeSideMenuDesktop"
    class="relative z-20 flex-shrink-0 hidden px-2 overflow-y-auto bg-teal-600 md:block" id="sidebar">

    <div class="mb-6 animate" id="nav-items">
        <div class="text-indigo-300">
            <div class="p-2 my-2 bg-gray-200 rounded-md">
                <div class="flex justify-center ">
                    <img src="{{asset('img/power_button.png')}}" class="w-auto h-10"  />
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