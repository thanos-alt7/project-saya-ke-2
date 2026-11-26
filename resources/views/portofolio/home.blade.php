<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Portfolio Home
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <h3 class="text-xl font-bold mb-4">
                Featured Projects
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @forelse ($featured as $project)
                <div class="bg-white p-5 rounded shadow">
                    <h4 class="font-bold">
                        {{ $project->name }}
                    </h4>

                    <p class="text-gray-600">
                        {{ $project->category->name ?? '-' }}
                    </p>
                </div>
                @empty
                <p>Belum ada project unggulan.</p>
                @endforelse
            </div>

            <h3 class="text-xl font-bold mt-8 mb-4">
                Skills
            </h3>

            <div class="flex flex-wrap gap-2">
                @forelse ($skills as $skill)
                <span class="bg-gray-200 px-3 py-1 rounded">
                    {{ $skill->name }}
                </span>
                @empty
                <p>Belum ada skill.</p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>