<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8">
                    {{-- Grid utama untuk 2 kolom --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">

                        <div class="flex flex-col justify-center">
                            <div>
                                <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-gray-100">
                                    {{ $data->nama_ruangan }}
                                </h1>
                                <p class="text-md text-gray-900 dark:text-gray-400 mt-2">
                                    Kode Ruangan : <span class="font-bold">{{ $data->kode_ruangan }}</span>
                                </p>
                                <p class="text-md text-gray-900 dark:text-gray-400 mt-2">
                                    Penanggung Jawab : <span class="font-bold">{{ $data->petugas->name }}</span>
                                </p>
                                <p class="text-md text-gray-900 dark:text-gray-400 mt-2">
                                    Lantai : <span class="font-bold">{{ $data->lantai }}</span>
                                </p>
                                <p class="text-md text-gray-900 dark:text-gray-400 mt-2">
                                    Ukuran :

                                    @switch($data->ukuran)
                                        @case('small')
                                            <span class="text-blue-500">Ruangan Kecil</span>
                                        @break

                                        @case('medium')
                                            <span class="text-yellow-500">Ruangan Sedang</span>
                                        @break

                                        @default
                                            <span class="text-green-500">Ruangan Besar</span>
                                    @endswitch
                                </p>

                                <img src="{{ asset('storage/images/ruangan/' . $data->gambar) }}" alt="">

                                <p class="text-md text-gray-900 dark:text-gray-400 mt-2">
                                    Deskripsi : <span class="font-bold">{{ $data->deskripsi }}</span>
                                </p>


                                <form action="" method="post" class="py-6">
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
            <form method="POST" action="" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="space-y-2">
                    <div>
                        <x-input-label for="kode_ruangan_r" value="Kode Ruangan" />
                        <x-text-input id="kode_ruangan_r" name="kode_ruangan" value="{{ $data->kode_ruangan }}" type="text" class="mt-1 block w-full"
                            placeholder="Contoh: R-01" required />
                    </div>
                    <div>
                        <x-input-label for="nama_ruangan_r" value="Nama Ruangan" />
                        <x-text-input id="nama_ruangan_r" name="nama_ruangan" type="text" value="{{ $data->nama_ruangan }}" class="mt-1 block w-full"
                            required />
                    </div>
                    <div>
                        <x-input-label for="penanggung_jawab" value="Penanggung Jawab Ruangan" />
                        <select name="user_id" required
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            id="">
                            <option value="{{ $data->user_id }}">{{ $data->petugas->name }}</option>
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
                            <option value="{{ $data->lantai }}">{{ $data->lantai }}</option>
                            <option value="basement">Basement</option>
                            <option value="grand floor">Grand Floor</option>
                            <option value="lantai 1">Lantai 1</option>
                            <option value="lantai 2">Lantai 2</option>
                            <option value="lantai 3">Lantai 3</option>
                            <option value="lantai 3A">Lantai 3A</option>
                        </select>
                    </div>
                    <div>
                        <x-input-label for="ukuran" value="Ukuran" />
                        <select name="ukuran" required
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            id="">
                            <option value="{{ $data->ukuran }}">{{ $data->ukuran }}</option>
                            <option value="small">small</option>
                            <option value="medium">medium</option>
                            <option value="large">large</option>
                            <option value="extra large">extra large</option>
                        </select>
                    </div>
                    <div>
                        <x-input-label for="gambar" value="Gambar Ruangan" />
                        <x-text-input id="gambar" name="gambar" type="file" accept="image/*"
                            class="mt-1 block w-full p-4 border " />
                    </div>
                    <div>
                        <x-input-label for="deskripsi_r" value="Deskripsi" />
                        <textarea id="deskripsi_r" name="deskripsi"
                            class="mt-1 block w-full border-gray-300 
                            dark:border-gray-700 dark:bg-gray-900 
                            dark:text-gray-300 focus:border-indigo-500 
                            dark:focus:border-indigo-600 
                            focus:ring-indigo-500 dark:focus:ring-indigo-600 
                            rounded-md shadow-sm">{{ $data->deskripsi }}</textarea>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" x-on:click="$dispatch('close')""
                        class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                        Batal
                    </button>
                    <x-primary-button class="ml-3">
                        Simpan Ruangan
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>
</x-app-layout>
