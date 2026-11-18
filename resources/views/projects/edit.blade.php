<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Project
        </h2>
    </x-slot>

    @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <form action="{{ route('post.projects.update', $project->id) }}"
                method="POST"
                enctype="multipart/form-data"
                class="bg-white p-6 rounded-lg shadow">

                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label>Nama Project</label>
                    <input type="text" name="name"
                        value="{{ old('name', $project->name) }}"
                        class="w-full border rounded p-2" required>
                    @error('name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label>Kategori</label>
                    <select name="category_id"
                        class="w-full border rounded p-2" required>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            @selected(old('category_id', $project->category_id) == $category->id)>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Skills --}}
                <div class="mb-4">
                    <label>Skills</label>

                    <select name="skills[]"
                        multiple
                        class="w-full border rounded p-2">

                        @foreach ($skills as $skill)
                        <option value="{{ $skill->id }}"
                            @selected(in_array(
                            $skill->id,
                            old('skills', $project->skills->pluck('id')->toArray())
                            ))>
                            {{ $skill->name }}
                        </option>
                        @endforeach
                    </select>

                    <p class="text-gray-500 text-sm">
                        Tekan Ctrl untuk memilih beberapa Skill.
                    </p>

                    @error('skills')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror

                    @error('skills.*')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label>Deskripsi Singkat</label>
                    <input type="text" name="short_description"
                        value="{{ old('short_description', $project->short_description) }}"
                        class="w-full border rounded p-2">
                    @error('short_description')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label>Deskripsi Project</label>
                    <textarea name="description"
                        rows="4"
                        class="w-full border rounded p-2">{{ old('description', $project->description) }}</textarea>
                    @error('description')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label>Status Project</label>
                    <select name="status"
                        class="w-full border rounded p-2" required>
                        <option value="draft"
                            @selected(old('status', $project->status) == 'draft')>
                            Draft
                        </option>
                        <option value="published"
                            @selected(old('status', $project->status) == 'published')>
                            Published
                        </option>
                    </select>
                    @error('status')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label>Project URL</label>
                    <input type="url" name="project_url"
                        value="{{ old('project_url', $project->project_url) }}"
                        class="w-full border rounded p-2">
                    @error('project_url')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label>Repository URL</label>
                    <input type="url" name="repository_url"
                        value="{{ old('repository_url', $project->repository_url) }}"
                        class="w-full border rounded p-2">
                    @error('repository_url')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label>Thumbnail Saat Ini</label><br>

                    @if ($project->thumbnail)
                    <img src="{{ asset('storage/' . $project->thumbnail) }}"
                        class="w-32 h-auto rounded my-2"
                        alt="Thumbnail Project">
                    @else
                    <p class="text-gray-500 text-sm">Belum ada thumbnail.</p>
                    @endif
                </div>

                <div class="mb-4">
                    <label>Ganti Thumbnail (Opsional)</label>
                    <input type="file" name="thumbnail"
                        accept="image/*"
                        class="w-full border rounded p-2">
                    @error('thumbnail')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded">
                    Perbarui Project
                </button>
            </form>

            <div class="bg-white p-6 rounded-lg shadow mt-6">
                <h3 class="text-lg font-semibold mb-4">
                    Upload Gallery
                </h3>

                <form action="{{ route('post.projects.gallery.store', $project->id) }}"
                    method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label>Pilih Beberapa Gambar</label>
                        <input type="file"
                            name="images[]"
                            multiple
                            accept="image/*"
                            class="w-full border rounded p-2"
                            required>
                    </div>

                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded">
                        Upload Gallery
                    </button>
                </form>
            </div>

            <div class="bg-white p-6 rounded-lg shadow mt-6">
                <h3 class="text-lg font-semibold mb-4">
                    Gallery Project
                </h3>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @forelse ($project->images as $image)
                    <div>
                        <img src="{{ asset('storage/' . $image->image) }}"
                            class="w-full h-32 object-cover rounded"
                            alt="Gallery Project">

                        <form action="{{ route('post.projects.gallery.update', [$project->id, $image->id]) }}" method="POST" class="mt-2">
                            @csrf
                            @method('PUT')

                            <input
                                type="text"
                                name="caption"
                                value="{{ old('caption', $image->caption) }}"
                                placeholder="Caption gambar"
                                class="w-full border rounded p-2">

                            @error('caption')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror

                            <button type="submit"
                                class="bg-blue-600 text-white px-3 py-2 rounded w-full mt-3 block">
                                Simpan Caption
                            </button>
                        </form>

                        <form action="{{ route('post.projects.gallery.destroy', [$project->id, $image->id]) }}"
                            method="POST"
                            onsubmit="return confirm('Hapus gambar ini?')"
                            class="mt-2">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="bg-red-600 text-white px-3 py-2 rounded w-full">
                                Hapus Gambar
                            </button>
                        </form>
                    </div>
                    @empty
                    <p>Belum ada gambar gallery.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>