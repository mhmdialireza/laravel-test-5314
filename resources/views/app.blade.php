<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link rel="stylesheet" href="{{ asset('assets/styles/bootstrap.rtl.min.css') }}">
</head>

<body dir="rtl">
    <main class="container vh-100">
        <div class="py-5 grid">
            @yield('content')
        </div>
    </main>
</body>

</html>
