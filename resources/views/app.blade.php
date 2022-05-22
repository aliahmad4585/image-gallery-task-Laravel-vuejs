<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ __('project.name') }}</title>
    <!-- External -->
    <link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.10/components/menu.min.css">
    <!-- Internal -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="https://www.studydrive.net/image/favicons/16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="https://www.studydrive.net/image/favicons/32x32.png" sizes="32x32">

    <meta name="apple-mobile-web-app-title" content="{{ __('project.name') }}">
    <meta name="application-name" content="{{ __('project.name') }}">
    <meta name="theme-color" content="#ffffff">
    <meta name="user-id" content="{{ optional(Auth::user())->id }}">
    <meta name="weekday" content="{{ $project }}">
</head>

<body>

    @section('header')
    <header style="background:linear-gradient(#0b3868, #87bce6) !important;">
        <div class="container">
            <a href="{{ url('/') }}"><img src="https://www.studydrive.net/images/logos/logo-text-studydrive.svg" width="170" alt="Logo" /></a>

            <div class="auth">

                @if ($project)
                <a href="{{ url('/?weekend=1') }}">
                    <input class="btn btn-info" type="submit" name="search" value="{{ __('home.switch_weekend') }}" style="margin-right:150px" />
                </a>
                @else
                <a href="{{ url('/?weekday=1') }}">
                    <input class="btn btn-info" type="submit" name="search" value="{{ __('home.switch_weekday') }}" style="margin-right:150px" />
                </a>
                @endif

                <i class="material-icons">account_circle</i>
                @auth
                <a href="{{ url('/home') }}">{{ __('home.welcome') }}, {{ Auth::user()->name }}</a>
                |
                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @else
                <a href="#"> {{ __('home.welcome') }}, {{ "Guest" }} </a>
                @if (!Request::is('register'))
                <a href="{{ url('/register') }}">{{ __('home.register') }}</a> |
                @endif
                <a href="{{ url('/login') }}">{{ __('home.login') }}</a>
                @endauth



            </div>
        </div>
        </div>
    </header>
    @show

    <main>
        @section('main')
        @show
    </main>
    @section('footer')
    <footer style="background: #08120a; color:white; position: fixed;
  left: 0;
  bottom: 0;
  padding:5px !important;
  width: 100%;
  background-color: #08120a;
  color: white;
  text-align: center;">
        <div class="container">
            <center> &copy; {{ date('Y') }} &nbsp;&ndash;&nbsp; {{ __('project.name') }} </center>
        </div>
    </footer>
    @show

    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.10/dist/vue.min.js"></script>
    <script src="https://unpkg.com/vuejs-paginate@latest"></script>
    <script src="{{ asset('js/bundle.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
</body>

</html>