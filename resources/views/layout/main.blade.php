<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>トリコクック</title>
    <link rel="shortcut icon" href="{{ asset('favicon.svg')}}" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css')}}">
    <script src="{{ asset('js/script.js')}}" defer></script>
</head>

<body>

    @include('layout.header')
    <main class="main-container">
        <section class="content-container">
            @yield('content')
        </section>
    </main>

</body>

</html>
