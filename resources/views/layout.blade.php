<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('head')
    @if(session()->has('notification'))
        <script>
            window.notifications = [{!! json_encode(session('notification')) !!}];
            console.log(window.notifications);
        </script>
    @endif
</head>
<body class="@yield('body_class')">
@yield('body_start')
<div id="wrap">
    <header>
        <div class="container">
            <nav>
                <ul>
                    <li><a href="{{ url('/') }}" class="brand">H</a></li>
                    @include('nav.main', ['menu' => $menu, 'level' => 0])
                </ul>
            </nav>
            <div class="header-info">
                <ul>
                    <li>
                        <i class="fa fa-phone"></i> <a
                                href="tel:{{ preg_replace('/[^\d\+]/','',config('settings.contact_phone')) }}"
                                class="phone">{{ config('settings.contact_phone') }}</a>
                    </li>
                    <li>
                        <i class="fa fa-envelope"></i> <a href="mailto:{{ config('settings.contact_email') }}"
                                                          class="phone">{{ config('settings.contact_email') }}</a>
                    </li>
                    <li class="dropdown">
                        <i class="fa fa-globe"></i> {{ \Backpack\LangFileManager\app\Models\Language::findByAbbr(app()->getLocale())->native }}
                        <ul class="dropdown-menu">
                            @foreach($languages as $code => $lang)
                                @if(app()->getLocale() != $code)
                                    <li><a href="{{ route('lang.switch', $code) }}">{{ $lang['native'] }}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div id="content">
        @yield('content')
    </div>
</div>
<footer>
    <div class="container">
        <div class="copyright">Hotel &laquo;H&raquo; &copy; 2017</div>
    </div>
</footer>

<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
@yield('body_end')
</body>
</html>