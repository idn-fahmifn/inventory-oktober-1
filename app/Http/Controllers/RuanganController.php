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
        $petugas = User::where('is_admin', false)->get();
        return view('ruangan.index', compact('petugas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ruangan' => ['required', 'string', 'max:100'],
            'user_id' => ['required', 'numeric'],
            'kode_ruangan' => ['required', 'string', 'max:100', 'unique:ruangan'],
            'lantai' => ['required', 'string', 'max:20'],
            'ukuran' => ['required', 'string', 'max:20'],
            'gambar' => ['required', 'file', 'mimes:png,jpg,jpeg,webp,gif,svg,heic', 'max:10240'],
            'deskripsi' => ['required']
        ]);

        $simpan = [
            'user_id' => $request->input('user_id'),
            'nama_ruangan' => $request->input('nama_ruangan'),
            'kode_ruangan' => $request->input('kode_ruangan'),
            'lantai' => $request->input('lantai'),
            'ukuran' => $request->input('ukuran'),
            'deskripsi' => $request->input('deskripsi'),
        ];

        // kondisi upload image
        if($request->hasFile('gambar')){
            $path = 'public/images/ruangan'; // path
            $gambar = $request->file('gambar'); //gambar
            $nama = 'gambar-ruangan_'.Carbon::now()->format('Ymdhis').'.'.$gambar->getClientOriginalExtension(); //mengganti nama
            $simpan['gambar'] = $nama;
            $gambar->storeAs($path, $nama);
        }
        // return $simpan;

        Ruangan::create($simpan);

    }
}
