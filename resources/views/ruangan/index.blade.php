<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Data Master Ruangan
            </h2>
            {{-- Tombol 'Tambah' --}}
            <button onclick="document.getElementById('createRuanganModal').showModal()"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition duration-150 shadow-md">
                + Tambah Ruangan
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
                                    Kode Ruangan</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Nama Ruangan</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Lantai</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            <tr>
                                <td colspan="4"
                                    class="px-6 py-4 text-center text-sm italic text-gray-500 dark:text-gray-400">
                                    Belum ada data ruangan.
                                </td>
                            </tr>
                            {{-- Loop data ruangan akan masuk di sini --}}
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    {{-- Modal Create Data Ruangan --}}
    <dialog id="createRuanganModal" class="p-0 backdrop:bg-black/50 rounded-lg shadow-2xl dark:bg-gray-900">
        <div class="p-6 w-[400px]">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 border-b pb-2 dark:border-gray-700">
                Input Ruangan Baru</h3>
            <form method="POST" action="#">
                @csrf
                <div class="space-y-2">
                    <div>
                        <x-input-label for="kode_ruangan_r" value="Kode Ruangan" />
                        <x-text-input id="kode_ruangan_r" name="kode_ruangan" type="text" class="mt-1 block w-full"
                            placeholder="Contoh: R-01" required />
                    </div>
                    <div>
                        <x-input-label for="nama_ruangan_r" value="Nama Ruangan" />
                        <x-text-input id="nama_ruangan_r" name="nama_ruangan" type="text" class="mt-1 block w-full"
                            required />
                    </div>
                    <div>
                        <x-input-label for="penanggung_jawab" value="Penanggung Jawab Ruangan" />
                        <select name="user_id" required
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            id="">
                            <option value="">-pilih petugas-</option>
                            @foreach ($petugas as $row)
                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <x-input-label for="nama_ruangan_r" value="Lantai" />
                        <select name="lantai" required
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            id="">
                            <option value="">-pilih lantai-</option>
                            <option value="basement">Basement</option>
                            <option value="grand floor">Grand Floor</option>
                            <option value="lantai 1">Lantai 1</option>
                            <option value="lantai 2">Lantai 2</option>
                            <option value="lantai 3">Lantai 3</option>
                            <option value="lantai 3A">Lantai 3A</option>
                        </select>
                    </div>
                    <div>
                        <x-input-label for="nama_ruangan_r" value="Lantai" />
                        <select name="lantai" required
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            id="">
                            <option value="">-Pilih Ukuran-</option>
                            <option value="small">small</option>
                            <option value="medium">medium</option>
                            <option value="large">large</option>
                            <option value="extra large">extra large</option>
                        </select>
                    </div>
                    <div>
                        <x-input-label for="gambar" value="Gambar Ruangan" />
                        <x-text-input id="gambar" name="gambar" type="file"
                            class="mt-1 block w-full p-4 border " required />
                    </div>
                    <div>
                        <x-input-label for="deskripsi_r" value="Deskripsi" />
                        <textarea id="deskripsi_r" name="deskripsi"
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"></textarea>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" onclick="document.getElementById('createRuanganModal').close()"
                        class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                        Batal
                    </button>
                    <x-primary-button class="ml-3">
                        Simpan Ruangan
                    </x-primary-button>
                </div>
            </form>
        </div>
    </dialog>
</x-app-layout>
