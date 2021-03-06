<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>Aggregator</title>
</head>
<body class="antialiased bg-gray-100">
    <div class="sm:flex min-h-screen">
        <div class="bg-blue-800 px-6 sm:px-0 py-4 sm:py-8 text-white flex sm:w-20 sm:flex-col items-center justify-between">
            <div class="flex sm:flex-col space-x-4 sm:space-x-0 sm:space-y-4">
                <a href="{{ route('feeds.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </a>
                <a href="{{ route('feeds.create') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </a>
            </div>
            <div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a href="{{ route('logout') }}"
                                     onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </a>
                </form>
            </div>
        </div>
        <div class="flex-1 p-6 sm:p-16">
            <div class="max-w-screen-lg mx-auto">
                <div class="bg-white p-6 sm:p-16">{{ $slot }}</div>
            </div>
        </div>
    </div>
</body>
</html>
