<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pesan Masuk
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <div class="p-6">

                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        Daftar Pesan Contact
                    </h3>

                    @if ($contacts->isEmpty())
                    <p class="text-gray-500">
                        Belum ada pesan yang masuk.
                    </p>
                    @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subjek</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Waktu</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-gray-200">
                                @foreach ($contacts as $contact)
                                <tr>
                                    <td class="px-4 py-3 text-sm text-gray-800">
                                        {{ $contact->name }}
                                    </td>

                                    <td class="px-4 py-3 text-sm text-gray-600">
                                        {{ $contact->email }}
                                    </td>

                                    <td class="px-4 py-3 text-sm text-gray-600">
                                        {{ $contact->subject ?? '-' }}
                                    </td>

                                    <td class="px-4 py-3 text-sm text-gray-600">
                                        {{ $contact->created_at->format('d-m-Y H:i') }}
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        @if ($contact->is_read)
                                        <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">
                                            Sudah Dibaca
                                        </span>
                                        @else
                                        <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-700">
                                            Belum Dibaca
                                        </span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        <a href="{{ route('post.contacts.show', $contact) }}"
                                            class="text-blue-600 hover:text-blue-800">
                                            Lihat Detail
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $contacts->links() }}
                    </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</x-app-layout>