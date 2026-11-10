<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Project
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <form action="{{ route('post.projects.store') }}"
                method="POST"
                enctype="multipart/form-data"
                class="bg-white p-6 rounded-lg shadow">
                @csrf

                <div class="mb-4">
                    <label>Nama Project</label>
                    <input type="text" name="name"
                        class="w-full border rounded p-2"
                        required>
                </div>

                <div class="mb-4">
                    <label>Kategori</label>
                    <select name="category_id"
                        class="w-full border rounded p-2"
                        required>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label>Thumbnail</label>
                    <input type="file" name="thumbnail"
                        accept="image/*"
                        class="w-full border rounded p-2">
                </div>

                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded">
                    Simpan Project
                </button>
            </form>
        </div>
    </div>
</x-app-layout>