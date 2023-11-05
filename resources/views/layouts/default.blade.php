<!DOCTYPE HTML>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/styles.css')}}" />
        <link rel="stylesheet" href="{{ asset('css/scrollbar.css')}}" />
        <link rel="stylesheet" href="{{ asset('css/upload.css')}}" />
        {{-- <link rel="stylesheet" href="{{ asset('css/fontawesome.css')}}" /> --}}
        {{-- <link rel="stylesheet" href="{{ asset('cdn/animate.css')}}" /> --}}
        {{-- <link rel="stylesheet" href="{{ asset('cdn/sweetalert2.css') }}"> --}}
    </head>

    <style>
        .swiper-container {
            width: 100%;
            padding-top: 50px;
            padding-bottom: 50px;
        }

        .swiper-slide {
            background-position: center;
            background-size: cover;
            width: 40%;
            height: 40%;
        }
    </style>

    <body>
        <div class="flex h-screen " :class="{ 'overflow-hidden': isSideMenuOpen }">
            {{-- @include('pages.loading.main-loading') --}}
            @include('include.sidebar.desktop')
    
            @include('include.sidebar.mobile')
    
    
            <div class="flex flex-col flex-1 w-full overflow-y-auto">
                @include('include.sidebar.topbar')
                <main class="relative z-0 flex-1 px-2 pb-8 bg-gray-200 md:px-6 sm:h-full">
                    <div class="grid pb-10 mt-10 ">
                        {{-- content --}}
                        @yield('content')
                    </div>
                </main>
            </div>
        </div>

        <!-- jQuery CDN -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
        
        <!-- jQuery Form -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" crossorigin="anonymous"></script>

        <!-- AJAX -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        
        <!-- Alpine JS -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        {{-- <script src="{{ asset('cdn/alpine.js')}}"></script> --}}
        {{-- <script src="{{ asset('js/init-alpine.js')}}"></script> --}}
        
        <!-- Sweetalert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            window.addEventListener('swal',function(e){Swal.fire(e.detail);});
        </script>

        <!-- JS used -->
        {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
        <script src="{{ asset('js/custom.js') }}"></script>
        {{-- <script src="{{ asset('cdn/sweetalert2.js') }}"></script> --}}

        @stack('js')
        
        {{-- <script>
            baseURL = "{{ config('app.url') }}";
        </script> --}}
    </body>
</html>