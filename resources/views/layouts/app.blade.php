<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Budget Calculator') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
@include('sweetalert::alert')
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/welcome') }}">
                Budget <span>Calculator.</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="/welcome">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif

                    @else

                        <!-- Admin functions -->

                        @if(Auth::user()->privilege=="admin")
                        <li class="nav-item">

                            <a class="nav-link" href="{{ route('showUsers') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('showUsers').submit();">
                                {{ __('Users') }}</a>
                            <form id="showUsers" action="{{ route('showUsers') }}" method="get" class="d-none">
                                @csrf
                            </form>
                        </li>
                            <li class="nav-item">

                                <a class="nav-link" href="{{ route('adminDash') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('adminDash').submit();">
                                    {{ __('Dashboard') }}</a>
                                <form id="adminDash" action="{{ route('adminDash') }}" method="get" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @else
                                <!-- User functions-->
                            <li class="nav-item">

                                <a class="nav-link" href="{{ route('getFoodExpenses') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('getFoodExpenses').submit();">
                                    {{ __('Food Expenses') }}</a>
                                <form id="getFoodExpenses" action="{{ route('getFoodExpenses') }}" method="get" class="d-none">
                                    @csrf
                                </form>
                            </li>
                            <li class="nav-item">

                                <a class="nav-link" href="{{ route('expenseDash') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('expenseDash').submit();">
                                    {{ __('Add Expense') }}</a>
                                <form id="expenseDash" action="{{ route('expenseDash') }}" method="get" class="d-none">
                                    @csrf
                                </form>
                            </li>
                            @endif
                        <li class="nav-item">

                            <a class="nav-link" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                        <li class="nav-item">
                            <a id="navbarDropdown" class="nav-link"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                              <strong style="color: black"> {{ Auth::user()->firstName}} {{Auth::user()->lastName}} ({{Auth::user()->privilege}})</strong>
                            </a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>
