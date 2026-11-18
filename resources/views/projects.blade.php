<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Portfolio Projects
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Search dan Filter --}}
            <form action="{{ route('projects') }}" method="GET"
                class="bg-white rounded-lg shadow p-4 mb-6">

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                    {{-- Search --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">
                            Cari Project
                        </label>
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Masukkan nama project..."
                            class="w-full border-gray-300 rounded-md">
                    </div>

                    {{-- Filter Kategori --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">
                            Kategori
                        </label>
                        <select name="category"
                            class="w-full border-gray-300 rounded-md">
                            <option value="">Semua Kategori</option>

                            @foreach ($categories as $category)
                            <option value="{{ $category->slug }}"
                                {{ request('category') == $category->slug ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Filter Skill --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">
                            Skill
                        </label>
                        <select name="skill"
                            class="w-full border-gray-300 rounded-md">
                            <option value="">Semua Skill</option>

                            @foreach ($skills as $skill)
                            <option value="{{ $skill->slug }}"
                                {{ request('skill') == $skill->slug ? 'selected' : '' }}>
                                {{ $skill->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Sorting --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">
                            Urutkan
                        </label>
                        <select name="sort"
                            class="w-full border-gray-300 rounded-md">
                            <option value="terbaru"
                                {{ request('sort', 'terbaru') == 'terbaru' ? 'selected' : '' }}>
                                Terbaru
                            </option>
                            <option value="terlama"
                                {{ request('sort') == 'terlama' ? 'selected' : '' }}>
                                Terlama
                            </option>
                            <option value="az"
                                {{ request('sort') == 'az' ? 'selected' : '' }}>
                                Nama A-Z
                            </option>
                            <option value="tanggal"
                                {{ request('sort') == 'tanggal' ? 'selected' : '' }}>
                                Tanggal Project
                            </option>
                        </select>
                    </div>

                </div>

                <div class="flex gap-2 mt-4">
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded">
                        Terapkan
                    </button>

                    <a href="{{ route('projects') }}"
                        class="bg-gray-200 text-gray-700 px-4 py-2 rounded">
                        Reset
                    </a>
                </div>
            </form>

            {{-- Jumlah Hasil --}}
            <p class="text-gray-600 mb-4">
                Menampilkan {{ $projects->count() }} dari
                {{ $projects->total() }} project.
            </p>

            {{-- Daftar Project --}}
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
                        {{ $project->category?->name ?? 'Tanpa Kategori' }}
                    </p>

                    <p class="text-gray-600 mt-2">
                        {{ $project->short_description }}
                    </p>

                    <a href="{{ route('projects.show', $project)}}"
                        class="inline-block bg-blue-600 text-white px-4 py-2 rounded mt-3">
                        Lihat Detail
                    </a>
                </div>
                @empty
                <p class="text-gray-500">
                    Project tidak ditemukan.
                </p>
                @endforelse
            </div>
            
            {{-- Pagination --}}
            <div class="mt-6">
                {{ $projects->links() }}
            </div>

        </div>
    </div>
</x-app-layout>