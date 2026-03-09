<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
</head>

@vite([
    'resources/css/app.css',
    'resources/js/app.js'
])

<body class="min-h-screen flex flex-col">
    <header class="w-full">
        @include('includes.header')
    </header>

    <main class="flex-1 flex items-center justify-center py-6">
        @yield('main')
    </main>

    <footer class="w-full">
        @include('includes.footer')
    </footer>
</body>
</html>
