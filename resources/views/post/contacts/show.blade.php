<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Pesan
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm rounded-lg p-6">

                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800">
                        {{ $contact->subject ?? 'Tanpa Subjek' }}
                    </h3>

                    <p class="text-sm text-gray-500 mt-1">
                        Dikirim pada
                        {{ $contact->created_at->format('d-m-Y H:i') }}
                    </p>
                </div>

                <div class="border-t border-gray-200 pt-5 space-y-4">
                    <div>
                        <p class="text-sm text-gray-500">Nama Pengirim</p>
                        <p class="font-medium text-gray-800">
                            {{ $contact->name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="font-medium text-gray-800">
                            {{ $contact->email }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Isi Pesan</p>
                        <p class="text-gray-800 whitespace-pre-line">
                            {{ $contact->message }}
                        </p>
                    </div>
                </div>

                <div class="mt-8">
                    <a href="{{ route('post.contacts.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700">
                        Kembali ke Daftar Pesan
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>