<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Ruangan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Barang::all();
        $ruangan = Ruangan::all();
        return view('barang.index', [
            'data' => $data,
            'ruangan' => $ruangan,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => ['required', 'string', 'max:100'],
            'ruangan_id' => ['required', 'numeric'],
            'kode_barang' => ['required', 'string', 'max:100', 'unique:barang'],
            'tipe' => ['required', 'string', 'max:20'],
            'brand' => ['required', 'string', 'max:20'],
            'kondisi' => ['required'],
            'jenis' => ['required'],
            'gambar' => ['required', 'file', 'mimes:png,jpg,jpeg,webp,gif,svg,heic', 'max:10240'],
            'deskripsi' => ['required']
        ]);
        // - buatkan array untuk save data

        $simpan = [
            'ruangan_id' => $request->input('ruangan_id'),
            'nama_barang' => $request->input('nama_barang'),
            'kode_barang' => $request->input('kode_barang'),
            'brand' => $request->input('brand'),
            'jenis' => $request->input('jenis'),
            'kondisi' => $request->input('kondisi'),
            'tipe' => $request->input('tipe'),
            'deskripsi' => $request->input('deskripsi'),
        ];


        // - kondisi untuk mengatur gambar
        if ($request->hasFile('gambar')) {
            $path = 'public/images/barang'; // path
            $gambar = $request->file('gambar'); //gambar
            $nama = 'gambar-barang_' . Carbon::now('Asia/Jakarta')->format('Ymdhis') . '.' . $gambar->getClientOriginalExtension(); //mengganti nama
            $simpan['gambar'] = $nama; //dikirimkan ke database 
            $gambar->storeAs($path, $nama);
        }

        // - Eloquent create data ruangan
        Barang::create($simpan);

        // - kembalikan nilai ke index.
        return redirect()->route('barang.index')->with('success', 'Data Berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show($param)
    {
        $data = Barang::where('kode_barang', $param)->first();
        $ruangan = Ruangan::all();
        if ($data === null) {
            return redirect()->
            route('barang.index')
            ->with('failed', 'data tidak ditemukan');
        }

        return view('barang.detail', compact('data', 'ruangan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $param)
    {
        $data = Barang::findOrFail($param);
        $request->validate([
            'nama_barang' => ['required', 'string', 'max:100'],
            'ruangan_id' => ['required', 'numeric'],
            'kode_barang' => ['required', 'string', 'max:100', 'unique:barang'],
            'tipe' => ['required', 'string', 'max:20'],
            'brand' => ['required', 'string', 'max:20'],
            'kondisi' => ['required'],
            'jenis' => ['required'],
            'gambar' => ['file', 'mimes:png,jpg,jpeg,webp,gif,svg,heic', 'max:10240'],
            'deskripsi' => ['required']
        ]);
        // - buatkan array untuk save data

        $simpan = [
            'ruangan_id' => $request->input('ruangan_id'),
            'nama_barang' => $request->input('nama_barang'),
            'kode_barang' => $request->input('kode_barang'),
            'brand' => $request->input('brand'),
            'jenis' => $request->input('jenis'),
            'kondisi' => $request->input('kondisi'),
            'tipe' => $request->input('tipe'),
            'deskripsi' => $request->input('deskripsi'),
        ];


        // - kondisi untuk mengatur gambar
        if ($request->hasFile('gambar')) {
            $old_path = 'public/images/barang/' . $data->gambar;
            if ($data->gambar && Storage::exists($old_path)) {
                Storage::delete($old_path);
            }
            $path = 'public/images/barang'; // path
            $gambar = $request->file('gambar'); //gambar
            $nama = 'gambar-barang_' . Carbon::now('Asia/Jakarta')->format('Ymdhis') . '.' . $gambar->getClientOriginalExtension(); //mengganti nama
            $simpan['gambar'] = $nama; //dikirimkan ke database 
            $gambar->storeAs($path, $nama);
        }

        // - Eloquent create data ruangan
        $data->update($simpan);

        // - kembalikan nilai ke index.
        return redirect()->route('barang.index')->with('success', 'Data Berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        //
    }
}
