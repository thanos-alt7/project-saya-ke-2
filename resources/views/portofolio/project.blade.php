<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Project
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white p-6 rounded-lg shadow">
                <h1 class="text-2xl font-bold mb-2">
                    {{ $project->name }}
                </h1>

                <p class="text-gray-500 mb-6">
                    Kategori: {{ $project->category->name }}
                </p>

                @if ($project->thumbnail)
                <img
                    src="{{ asset('storage/' . $project->thumbnail) }}"
                    alt="{{ $project->name }}"
                    class="w-full max-w-2xl rounded mb-6">
                @endif

                <h3 class="text-lg font-semibold mb-4">
                    Gallery Project
                </h3>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @forelse ($project->images as $image)
                    <img
                        src="{{ asset('storage/' . $image->image) }}"
                        alt="{{ $image->caption ?: $project->name }}"
                        class="w-full h-40 object-cover rounded">
                    @empty
                    <p>Belum ada gambar gallery.</p>
                    @endforelse
                </div>

                <a href="{{ route('projects') }}"
                    class="inline-block bg-gray-600 text-white px-4 py-2 rounded mt-6">
                    Kembali
                </a>
            </div>

        </div>
    </div>
</x-app-layout>