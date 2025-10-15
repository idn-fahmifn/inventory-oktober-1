<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index()
    {
        $petugas = User::where('is_admin', false)->get();
        return view('ruangan.index', compact('petugas'));
    }
}
