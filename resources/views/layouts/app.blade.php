<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .pagination {
            display: flex;
            justify-content: center;
        }

        .pagination li {
            display: block;
        }

        .required {
            color: red;
        }
    </style>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">

            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('web.toggle_navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ strtoupper(config('app.locale', 'en')) }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" >
                                <li><a class="dropdown-item lang" data-locale="en" href="javascript:void(0)"><img src="{{ asset('icons/en.svg') }}" class="img-responsive" width="18px" /> English </a></li>
                                <li><a class="dropdown-item lang" data-locale="ja" href="javascript:void(0)"><img src="{{ asset('icons/ja.svg') }}" class="img-responsive" width="18px" /> 日本語 </a></li>
                            </ul>
                        </li>
                        @if (!Auth::guest())

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('web.logout') }}
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
            @if (!Auth::guest())
            <div class="container" style="margin-bottom: 20px;">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <a href="{{ action('Web\DashboardController@index') }}" class="btn">{{ __('web.menu') }}</a>
                        <a href="{{ action('Web\OrderController@index') }}" class="btn">{{ __('web.orders') }}</a>
                    </div>
                </div>
            </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $('.lang').click(function(){
            var lang = $(this).data('locale');
            $.ajax({
                url: "{{ action('Web\SetLocaleController') }}" ,
                type: "POST",
                data: '_token='+$('meta[name=csrf-token]').attr("content")+'&lang='+lang,
                success: function( response ) {
                    location.reload();
                }
            });
        });
    </script>
    @stack('scripts')

</body>
</html>
