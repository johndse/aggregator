<x-app-layout>
    <h2 class="text-3xl text-blue-800 mb-6">Update feed</h2>
    <form method="POST" action="{{ route('feeds.update', ['feed' => $feed->id]) }}">
        @method('PUT')
        @csrf

        <div class="space-y-4">
            <div>
                <label for="name" class="block font-bold mb-2">Name</label>
                <input class="block px-4 py-1.5 w-full border-2 border-gray-300" value="{{ old('name', $feed->name) }}" type="text" id="name" name="name">
            </div>
            <div>
                <label for="link" class="block font-bold mb-2">Link</label>
                <input class="block px-4 py-1.5 w-full border-2 border-gray-300" value="{{ old('name', $feed->link) }}" type="url" id="link" name="link"
                       placeholder="https://example.com/rss.xml"
                       pattern="https://.*"
                       required>
            </div>

            <button class="bg-blue-800 hover:bg-blue-600 text-white px-8 py-1.5 font-bold" type="submit">Update feed</button>
        </div>
    </form>
</x-app-layout>
