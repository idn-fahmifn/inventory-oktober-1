<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Data Master Petugas
            </h2>
            {{-- Tombol 'Tambah' --}}
            <button onclick="document.getElementById('tampilkanModal').showModal()"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition duration-150 shadow-md">
                + Tambah Petugas
            </button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">

                <div class="overflow-x-auto">
                    {{-- Tabel untuk menampilkan data ruangan (kosong) --}}
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Nama Petugas</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Email</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($data as $item)
                            <tr>
                                <td 
                                    class="px-6 py-2 text-sm italic text-gray-500 dark:text-gray-400">
                                    {{ $item->name }}
                                </td>
                                <td 
                                    class="px-6 py-2 text-sm italic text-gray-500 dark:text-gray-400">
                                    {{ $item->email }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4"
                                    class="px-6 py-4 text-center text-sm italic text-gray-500 dark:text-gray-400">
                                    Belum ada data Petugas.
                                </td>
                            </tr>
                            @endforelse
                            
                            {{-- Loop data ruangan akan masuk di sini --}}
                        </tbody>
                    </table>

                    <div class="mt-3">
                        {{ $data }}
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Modal Create Data Ruangan --}}
    <dialog id="tampilkanModal" class="p-0 backdrop:bg-black/50 rounded-lg shadow-2xl dark:bg-gray-900">
        <div class="p-6 w-[400px]">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 border-b pb-2 dark:border-gray-700">
                Input Petugas Baru</h3>
            <form method="POST" action="{{ route('petugas.store') }}">
                @csrf
                <div class="space-y-2">
                    <div>
                        <x-input-label for="name" value="Nama Petugas" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                            placeholder="Asep" required />
                    </div>
                    <div>
                        <x-input-label for="email" value="Alamat Email" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" required
                            placeholder="asep@test.com" />
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('tampilkanModal').close()"
                        class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                        Batal
                    </button>
                    <x-primary-button class="ml-3">
                        Simpan Petugas
                    </x-primary-button>
                </div>
            </form>
        </div>
    </dialog>
</x-app-layout>
