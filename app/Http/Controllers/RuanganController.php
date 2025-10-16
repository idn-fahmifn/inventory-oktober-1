<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index()
    {
        $data = Ruangan::all();
        $petugas = User::where('is_admin', false)->get();
        return view('ruangan.index', compact('petugas', 'data'));
    }

    public function store(Request $request)
    {
        // - buat validasi data

        $request->validate([
            'nama_ruangan' => ['required', 'string', 'max:100'],
            'user_id' => ['required', 'numeric'],
            'kode_ruangan' => ['required', 'string', 'max:100', 'unique:ruangan'],
            'lantai' => ['required', 'string', 'max:20'],
            'ukuran' => ['required', 'string', 'max:20'],
            'gambar' => ['required', 'file', 'mimes:png,jpg,jpeg,webp,gif,svg,heic', 'max:10240'],
            'deskripsi' => ['required']
        ]);
        // - buatkan array untuk save data

        $simpan = [
            'user_id' => $request->input('user_id'),
            'nama_ruangan' => $request->input('nama_ruangan'),
            'kode_ruangan' => $request->input('kode_ruangan'),
            'lantai' => $request->input('lantai'),
            'ukuran' => $request->input('ukuran'),
            'deskripsi' => $request->input('deskripsi'),
        ];


        // - kondisi untuk mengatur gambar
         if($request->hasFile('gambar')){
            $path = 'public/images/ruangan'; // path
            $gambar = $request->file('gambar'); //gambar
            $nama = 'gambar-ruangan_'.Carbon::now('Asia/Jakarta')->format('Ymdhis').'.'.$gambar->getClientOriginalExtension(); //mengganti nama
            $simpan['gambar'] = $nama; //dikirimkan ke database 
            $gambar->storeAs($path, $nama);
        }

        // - Eloquent create data ruangan
        Ruangan::create($simpan);

        // - kembalikan nilai ke index.
        return redirect()->route('ruangan.index')->with('success', 'Data Berhasil disimpan');
    }

    public function detail($param)
    {
        $data = Ruangan::where('kode_ruangan', $param)->first();
        $petugas = User::where('is_admin', false)->get();

        if ($data === null){
            return redirect()->route('ruangan.index')->with('failed', 'data tidak ditemukan');
        }


        return view('ruangan.detail', compact('petugas', 'data'));
    }
}
