<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/seeker.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/seeker.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel sticky-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                            <li class="nav-item nav-btn"><a class="nav-link" href="{{ route('login') }}">登陆</a></li>
                            <li class="nav-item nav-btn"><a class="nav-link" href="{{ route('register') }}">注册</a></li>
                        @else

                            <li class="nav-item nav-btn">
                                <form class="form-inline my-2 my-lg-0" action="{{ route('search.content') }}">
                                  <input class="form-control mr-sm-3" type="search" placeholder="Search" aria-label="Search" name='k'>
                                  <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">搜索</button>
                                </form>
                            </li>
                             <li class="nav-item nav-btn"><a class="btn btn-outline-success my-2 my-sm-0" href="{{ route('question.create') }}">提问</a></li>
                            <li class="nav-item nav-btn">
                            <a href="{{ route('notification.show') }}" class="btn btn-outline-warning my-2 my-sm-0"> 通知
                            @if(($unreadNotifications = Auth::user()->unreadNotifications->count()) !==0)
                            <span id="noti-num" data-id="{{ Auth::id() }}" class="badge">
                            {{ $unreadNotifications }}</span>
                            @else
                            <span id="noti-num" data-id="{{ Auth::id() }}" class="badge"></span>
                            @endif
                            </span>
                            </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img class="avatar-small" src="{{ asset('/images/avatar/'.Auth::user()->avatar) }}">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('user') }}">个人主页</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
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
<a id="current"></a>
</html>
