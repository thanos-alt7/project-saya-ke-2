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

                {{-- Nama Project --}}
                <div class="mb-4">
                    <label>Nama Project</label>
                    <input type="text" name="name"
                        value="{{ old('name') }}"
                        class="w-full border rounded p-2"
                        required>
                    @error('name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kategori --}}
                <div class="mb-4">
                    <label>Kategori</label>
                    <select name="category_id"
                        class="w-full border rounded p-2"
                        required>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            @selected(old('category_id')==$category->id)>
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
                            @selected(in_array($skill->id, old('skills', [])))>
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

                {{-- Short Description --}}
                <div class="mb-4">
                    <label>Deskripsi Singkat</label>
                    <input type="text" name="short_description"
                        value="{{ old('short_description') }}"
                        class="w-full border rounded p-2">
                    @error('short_description')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="mb-4">
                    <label>Deskripsi Lengkap</label>
                    <textarea name="description"
                        rows="5"
                        class="w-full border rounded p-2">{{ old('description') }}</textarea>
                    @error('description')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="mb-4">
                    <label>Status</label>
                    <select name="status"
                        class="w-full border rounded p-2"
                        required>
                        <option value="draft"
                            @selected(old('status', 'draft' )==='draft' )>
                            Draft
                        </option>
                        <option value="published"
                            @selected(old('status')==='published' )>
                            Published
                        </option>
                    </select>
                    @error('status')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Project URL --}}
                <div class="mb-4">
                    <label>Project URL</label>
                    <input type="url" name="project_url"
                        value="{{ old('project_url') }}"
                        placeholder="https://example.com"
                        class="w-full border rounded p-2">
                    @error('project_url')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Repository URL --}}
                <div class="mb-4">
                    <label>Repository URL</label>
                    <input type="url" name="repository_url"
                        value="{{ old('repository_url') }}"
                        placeholder="https://github.com/username/project"
                        class="w-full border rounded p-2">
                    @error('repository_url')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Thumbnail --}}
                <div class="mb-4">
                    <label>Thumbnail</label>
                    <input type="file" name="thumbnail"
                        accept="image/*"
                        class="w-full border rounded p-2">
                    @error('thumbnail')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded">
                    Simpan Project
                </button>
            </form>
        </div>
    </div>
</x-app-layout>