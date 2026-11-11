<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Skill
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b">
                            <th class="p-4">Nama Skill</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($skills as $skill)
                        <tr class="border-b">
                            <td class="p-4">
                                {{ $skill->name }}
                            </td>

                            <td class="p-4 text-center">
                                <a href="{{ route('skills.edit', $skill->id) }}"
                                    class="inline-flex items-center bg-amber-500 hover:bg-amber-600 text-white px-3 py-2 rounded">
                                    Edit
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="p-4 text-center">
                                Belum ada data Skill.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>