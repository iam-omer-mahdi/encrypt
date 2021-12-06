<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('css/linearicons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-rtl.min.css') }}">
    @stack('css')
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white border-bottom">
            <div class="container position-relative">
                <a class="navbar-brand d-flex align-items-center mx-auto @guest position-relative justify-content-center w-100 @endguest" href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="logo" width="50px">
                    <div class="d-flex flex-column text-center fs-6">
                        <small>حركة العدل و المساوة</small>
                        <small>امانة مكاتب اقليم دارفور</small>
                    </div>
                    <img src="{{ asset('images/logo.png') }}" alt="logo" width="50px">
                </a>
                
                @auth
                <button class="navbar-toggler mx-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <i class="lnr lnr-menu fw-bold"></i>
                </button>
                
                <div class="collapse navbar-collapse mt-4 mt-md-0" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link btn btn-success text-white d-flex align-items-center px-2" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="lnr lnr-cog fw-bold me-2"></i>
                                الاعدادات
                            </a>

                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @canany(['is-admin','is-superAdmin'])
                                    <a href="{{ route('users.index') }}" class="dropdown-item">
                                        <i class="lnr lnr-users me-1"></i>
                                        المستخدمين
                                    </a>
                                @endcanany
                                
                                <a href="{{ route('changePass',auth()->user()->id) }}" class="dropdown-item">
                                    <i class="lnr lnr-lock me-1"></i>
                                    تغير كلمة المرور
                                </a>

                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class="lnr lnr-power-switch me-1"></i>
                                    تسجيل الخروج
                                </a>
                                
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                    </ul>
                </div>
                @endauth
            </div>
        </nav>
        
        <main class="">
            @yield('content')
        </main>
    </div>
        <!-- Scripts -->
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        @stack('js')
        <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
