<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Admin
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <x-stat-card label="Total Projects" :value="$totalProjects" />

                <x-stat-card
                    label="Published"
                    :value="$totalPublished"
                    color="text-green-600" />

                <x-stat-card
                    label="Draft"
                    :value="$totalDraft"
                    color="text-yellow-600" />

                <x-stat-card
                    label="Categories"
                    :value="$totalCategories"
                    color="text-green-600" />

                <x-stat-card
                    label="Technologies"
                    :value="$totalTechnologies"
                    color="text-purple-600" />

                <x-stat-card
                    label="Skills"
                    :value="$totalSkills"
                    color="text-orange-600" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">

                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold mb-4">
                        Skill Teratas
                    </h3>

                    @forelse ($topSkills as $skill)
                    <div class="flex justify-between border-b py-3">
                        <span>{{ $skill->name }}</span>

                        <span class="font-semibold">
                            {{ $skill->projects_count }} Projects
                        </span>
                    </div>
                    @empty
                    <p>Belum ada data skill.</p>
                    @endforelse
                </div>

                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-semibold mb-4">
                        Project per Kategori
                    </h3>

                    @forelse ($categories as $category)
                    <div class="flex justify-between border-b py-3">
                        <span>{{ $category->name }}</span>

                        <span class="font-semibold">
                            {{ $category->projects_count }} Projects
                        </span>
                    </div>
                    @empty
                    <p>Belum ada kategori.</p>
                    @endforelse
                </div>

            </div>

        </div>
    </div>

</x-app-layout>