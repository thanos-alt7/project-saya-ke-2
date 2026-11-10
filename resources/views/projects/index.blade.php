<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Project
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
            @endif

            <a href="{{ route('post.projects.create') }}"
                class="inline-block bg-blue-600 text-white px-4 py-2 rounded mb-4">
                Tambah Project
            </a>

            <div class="bg-white rounded-lg shadow overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b">
                            <th class="p-4 text-center">Thumbnail</th>
                            <th class="p-4 text-center">Nama Project</th>
                            <th class="p-4 text-center">Kategori</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($projects as $project)
                        <tr class="border-b">
                            <td class="p-4 text-center">
                                @if ($project->thumbnail)
                                <img
                                    src="{{ asset('storage/' . $project->thumbnail) }}"
                                    class="w-20 h-auto object-cover rounded mx-auto"
                                    alt="Thumbnail Project">
                                @else
                                Belum ada gambar
                                @endif
                            </td>

                            <td class="p-4 text-center">
                                {{ $project->name }}
                            </td>

                            <td class="p-4 text-center">
                                {{ $project->category->name }}
                            </td>

                            <td class="p-4">
                                <div class="flex items-center justify-center gap-2">

                                    <a href="{{ route('post.projects.edit', $project->id) }}"
                                        class="inline-flex items-center bg-amber-500 hover:bg-amber-600 text-white px-3 py-2 rounded">
                                        Edit
                                    </a>

                                    <form action="{{ route('post.projects.destroy', $project->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus project ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-4 text-center">
                                Belum ada project.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>