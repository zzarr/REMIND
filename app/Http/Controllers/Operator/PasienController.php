<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Models\Pasien;

class PasienController extends Controller
{
    public function index()
    {
        return view('operator.pasien.index');
    }

    public function data(){
        $data = Pasien::get();

        return DataTables::of($data)->make(true);
    }

    public function store(Request $request){

        // Validasi data yang diterima dari permintaan
        $request->validate([
            'nama' => 'required',
            'usia' => 'required',
            'jenis_kelamin' => 'required',
        ]);

        // Simpan data ke dalam database
       Pasien::create([
            'nama' => $request->nama,
            'usia' => $request->usia,
            'jenis_kelamin' => $request->jenis_kelamin,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // return response JSON dengan pesan sukses
        return response()->json([
            'success' => true, // Ubah dari 'status' menjadi 'success'
            'message' => 'Akun berhasil ditambahkan',
        ]);

    }
}
