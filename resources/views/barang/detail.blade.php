<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8">
                    {{-- Grid utama untuk 2 kolom --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">

                        @if (session('success'))
                            <span>{{ session('success') }}</span>
                        @endif

                        @if ($errors->any())
                            @foreach ($errors->all() as $item)
                                {{ $item }}
                            @endforeach
                        @endif

                        <div class="flex flex-col justify-center">
                            <div>
                                <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-gray-100">
                                    {{ $data->nama_barang }}
                                </h1>
                                <p class="text-md text-gray-900 dark:text-gray-400 mt-2">
                                    Kode Barang : <span class="font-bold">{{ $data->kode_barang }}</span>
                                </p>
                                <p class="text-md text-gray-900 dark:text-gray-400 mt-2">
                                    Penyimpanan : <span class="font-bold">{{ $data->ruangan->nama_ruangan }}</span>
                                </p>
                                <p class="text-md text-gray-900 dark:text-gray-400 mt-2">
                                    Tipe : <span class="font-bold">{{ $data->tipe }}</span>
                                </p>
                                <p class="text-md text-gray-900 dark:text-gray-400 mt-2">
                                    Kondisi :

                                    @switch($data->ukuran)
                                        @case('sedang diperbaiki')
                                            <span class="text-yellow-500">maintenance</span>
                                        @break

                                        @case('rusak')
                                            <span class="text-red-500">broke</span>
                                        @break

                                        @default
                                            <span class="text-green-500">maintenance</span>
                                    @endswitch
                                </p>

                                <img src="{{ asset('storage/images/barang/' . $data->gambar) }}" alt="">

                                <p class="text-md text-gray-900 dark:text-gray-400 mt-2">
                                    Deskripsi : <span class="font-bold">{{ $data->deskripsi }}</span>
                                </p>


                                <form action="{{ route('barang.destroy', $data->id) }}" method="post" class="py-6">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" onclick="return confirm('Yakin mau dihapus?')"
                                        class="rounded-md bg-red-500 px-2.5 py-1.5 text-sm font-semibold text-white inset-ring inset-ring-white/5 hover:bg-red-700">Hapus</button>
                                    <button x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'show-edit')"
                                        class="rounded-md bg-yellow-500 px-2.5 py-1.5 text-sm font-semibold text-white inset-ring inset-ring-white/5 hover:bg-yellow-700">Edit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg p-4">

            </div>

        </div>
    </div>

    <x-modal name="show-edit" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <div class="p-6">
           <form method="POST" action="{{ route('barang.update', $data->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="space-y-2">
                    <div>
                        <x-input-label for="kode_barang" value="Kode Barang" />
                        <x-text-input id="kode_barang" name="kode_barang" value="{{ $data->kode_barang }}" type="text" class="mt-1 block w-full"
                            placeholder="Contoh: R-01" required />
                    </div>
                    <div>
                        <x-input-label for="nama_barang_r" value="Nama Barang" />
                        <x-text-input id="nama_barang_r" name="nama_barang" value="{{ $data->nama_barang }}" type="text" class="mt-1 block w-full"
                            required />
                    </div>
                     <div>
                        <x-input-label for="tipe_r" value="Tipe Barang" />
                        <x-text-input id="tipe_r" name="tipe" type="text" value="{{ $data->tipe }}" class="mt-1 block w-full"
                            required />
                    </div>
                     <div>
                        <x-input-label for="brand_r" value="Brand / Merk" />
                        <x-text-input id="brand_r" name="brand" type="text" value="{{ $data->brand }}" class="mt-1 block w-full"
                            required />
                    </div>
                    <div>
                        <x-input-label for="penyimpanam" value="Penyimpanan" />
                        <select name="ruangan_id" required
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            id="">
                            <option value="{{ $data->ruangan_id }}">{{ $data->ruangan->nama_ruangan }}</option>
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
                            <option value="{{ $data->jenis }}">{{ $data->jenis }}"</option>
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
                            <option value="{{ $data->kondisi }}">{{ $data->kondisi }}</option>
                            <option value="baik">baik</option>
                            <option value="rusak">rusak</option>
                            <option value="sedang diperbaiki">sedang diperbaiki</option>
                        </select>
                    </div>
                    <div>
                        <x-input-label for="gambar" value="Gambar barang" />
                        <x-text-input id="gambar" name="gambar" type="file" accept="image/*"
                            class="mt-1 block w-full p-4 border " />
                    </div>
                    <div>
                        <x-input-label for="deskripsi_r" value="Deskripsi" />
                        <textarea id="deskripsi_r" name="deskripsi"
                            class="mt-1 block w-full 
                            border-gray-300 
                            dark:border-gray-700 
                            dark:bg-gray-900 
                            dark:text-gray-300 focus:border-indigo-500 
                            dark:focus:border-indigo-600 focus:ring-indigo-500 
                            dark:focus:ring-indigo-600 
                            rounded-md shadow-sm">{{ $data->deskripsi }}</textarea>
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
    </x-modal>
</x-app-layout>
