<x-app-layout>
    <h2 class="text-3xl text-blue-800 mb-6">Feeds</h2>

    @foreach ($feeds as $feed)
        <a href="{{ route('feeds.show', ['feed' => $feed]) }}">{{ $feed->name }}</a>
    @endforeach
</x-app-layout>
