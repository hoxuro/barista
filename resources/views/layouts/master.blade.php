<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="icon" type="image/png" href="{{asset('assets/img/barista-beans.png')}}">

    @vite(['resources/sass/app.scss'])
    @yield('head')
</head>
<body>

@include('partials.header')

<main>
    @yield('content')
</main>

@include('partials.footer')

@vite(['resources/js/app.js'])
</body>
</html>
