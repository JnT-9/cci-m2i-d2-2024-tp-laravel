<!doctype html>
<html lang="en">
<head>
    <!-- META TAGS -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('meta')

    <!-- STYLE -->
    <link rel="stylesheet" href="{{ mix('assets/css/app.scss') }}">
    @yield('style')

    <!-- SCRIPT -->
    @yield('script-head')

    <title>@yield('title')</title>
</head>
<body>
    @include('components.menu')

    @if($errs = $errors->all())
        <section class="errors">
            <ul>
                @foreach($errs as $err)
                    <li class="text-danger">{{$err}}</li>
                @endforeach
            </ul>
        </section>
    @endif

    @if($message = session('message'))
        <section>
            <p class="text-success">
                {{ $message }}
            </p>
        </section>
    @endif

    <main>
        @yield('content')
    </main>

    @include('components.footer')

    <script src="{{ mix('assets/js/app.js') }}"></script>
    @yield('script-body')
</body>
</html>