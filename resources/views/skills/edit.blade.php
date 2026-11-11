<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Edit Skill
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">
            <form action="{{ route('skills.update', $skill->id) }}"
                method="POST"
                class="bg-white p-6 rounded-lg shadow">

                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label>Nama Skill</label>

                    <input type="text"
                        name="name"
                        value="{{ old('name', $skill->name) }}"
                        class="w-full border rounded p-2"
                        required>

                    @error('name')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded">
                    Perbarui Skill
                </button>
            </form>
        </div>
    </div>
</x-app-layout>