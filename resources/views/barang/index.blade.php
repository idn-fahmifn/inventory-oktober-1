<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Data Master Barang
            </h2>
            {{-- Tombol 'Tambah' --}}
            <button onclick="document.getElementById('createRuanganModal').showModal()"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition duration-150 shadow-md">
                + Tambah Barang
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
                                    Kode Barang</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Nama Barang</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Penyimpanan</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($data as $item)
                                <tr>
                                    <td class="px-6 py-2 text-sm text-gray-500 dark:text-gray-400">
                                        {{ $item->kode_ruangan }}
                                    </td>
                                    <td class="px-6 py-2 text-sm text-gray-500 dark:text-gray-400">
                                        {{ $item->nama_ruangan }}
                                    </td>
                                    <td class="px-6 py-2 text-sm text-gray-500 dark:text-gray-400">
                                        {{ $item->lantai }}
                                    </td>
                                    <td class="px-6 py-2 ">
                                        <a href="{{ route('barang.show', $item->kode_barang) }}"
                                            class="text-sm text-blue-500 dark:text-blue-200 font-semibold">Detail</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4"
                                        class="px-6 py-4 text-center text-sm italic text-gray-500 dark:text-gray-400">
                                        Belum ada data barang.
                                    </td>
                                </tr>
                            @endforelse

                            {{-- Loop data ruangan akan masuk di sini --}}
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    {{-- Modal Create Data Ruangan --}}
    <dialog id="createRuanganModal" class="p-0 backdrop:bg-black/50 rounded-lg shadow-2xl dark:bg-gray-900">
        <div class="p-6 w-[50dvw]">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 border-b pb-2 dark:border-gray-700">
                Input Barang Baru</h3>
            <form method="POST" action="{{ route('barang.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="space-y-2">
                    <div>
                        <x-input-label for="kode_barang" value="Kode Barang" />
                        <x-text-input id="kode_barang" name="kode_barang" type="text" class="mt-1 block w-full"
                            placeholder="Contoh: R-01" required />
                    </div>
                    <div>
                        <x-input-label for="nama_barang_r" value="Nama Barang" />
                        <x-text-input id="nama_barang_r" name="nama_barang" type="text" class="mt-1 block w-full"
                            required />
                    </div>
                     <div>
                        <x-input-label for="tipe_r" value="Tipe Barang" />
                        <x-text-input id="tipe_r" name="tipe" type="text" class="mt-1 block w-full"
                            required />
                    </div>
                     <div>
                        <x-input-label for="brand_r" value="Brand / Merk" />
                        <x-text-input id="brand_r" name="brand" type="text" class="mt-1 block w-full"
                            required />
                    </div>
                    <div>
                        <x-input-label for="penyimpanam" value="Penyimpanan" />
                        <select name="ruangan_id" required
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            id="">
                            <option value="">-pilih ruangan-</option>
                            @foreach ($ruangan as $row)
                                <option value="{{ $row->id }}">{{ $row->nama_ruangan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <x-input-label for="" value="Jenis" />
                        <select name="jenis" required
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            id="">
                            <option value="">-pilih jenis-</option>
                            <option value="alat berat">Alat Berat</option>
                            <option value="elektronik">elektronik</option>
                            <option value="atk">atk</option>
                            <option value="alat kebersihan">alat kebersihan</option>
                            <option value="kendaraan">kendaraan</option>
                            <option value="lainnya">lainnya</option>
                        </select>
                    </div>
                    <div>
                        <x-input-label for="" value="Kondisi" />
                        <select name="kondisi" required
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            id="">
                            <option value="">-Pilih Kondisi-</option>
                            <option value="baik">baik</option>
                            <option value="rusak">rusak</option>
                            <option value="sedang diperbaiki">sedang diperbaiki</option>
                        </select>
                    </div>
                    <div>
                        <x-input-label for="gambar" value="Gambar barang" />
                        <x-text-input id="gambar" name="gambar" type="file" accept="image/*"
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
                        Simpan Barang
                    </x-primary-button>
                </div>
            </form>
        </div>
    </dialog>
</x-app-layout>
