<x-app-layout>
    <h2 class="text-3xl text-blue-800 mb-6">Feeds</h2>

    @foreach ($feeds as $feed)
        {{ $feed->name }}
    @endforeach
</x-app-layout>
