<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>Aggregator</title>
</head>
<body class="antialiased mt-10">
    <div class="container mx-auto">
        <div class="grid grid-cols-2">
            <div class="cols-span-8">
                {{ $slot }}
            </div>
            <div></div>
        </div>
    </div>
</body>
</html>
