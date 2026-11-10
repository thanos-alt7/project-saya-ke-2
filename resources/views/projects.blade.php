<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Portfolio Projects
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse ($projects as $project)
                <div class="bg-white rounded-lg shadow p-4">
                    @if ($project->thumbnail)
                    <img
                        src="{{ asset('storage/' . $project->thumbnail) }}"
                        alt="{{ $project->name }}"
                        class="w-full h-48 object-cover rounded">
                    @endif

                    <h3 class="font-semibold text-lg mt-3">
                        {{ $project->name }}
                    </h3>

                    <p class="text-gray-500">
                        {{ $project->category->name }}
                    </p>

                    <a href="{{ route('projects.show', $project->id) }}"
                        class="inline-block bg-blue-600 text-white px-4 py-2 rounded mt-3">
                        Lihat Detail
                    </a>
                </div>
                @empty
                <p>Belum ada project.</p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>