<x-app-layout>
    <h2 class="text-3xl text-blue-800 mb-6">{{ $feed->name }}</h2>

    <div class="flex space-x-2 mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 5c7.18 0 13 5.82 13 13M6 11a7 7 0 017 7m-6 0a1 1 0 11-2 0 1 1 0 012 0z" />
        </svg>
        <a href="{{ $feed->link }}">Feed</a>
    </div>

    <div class="p-4 shadow-lg bg-blue-800 text-center">
        <div class="text-3xl text-blue-100 mb-2">{{ $count }}</div>
        <div class="text-blue-50 text-sm">Entries</div>
    </div>
</x-app-layout>
