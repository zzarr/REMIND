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

    public function edit($id)
    {
        $pasien = Pasien::findOrFail($id);

        return response()->json([
            'id' => $pasien->id,
            'nama' => $pasien->nama,
            'usia' => $pasien->usia,
            'jenis_kelamin' => $pasien->jenis_kelamin,
        ]);
    }

    public function update(Request $request, $id)
    {
    

        $pasien = Pasien::findOrFail($id);
        $pasien->nama = $request->nama;
        $pasien->usia = $request->usia;
        $pasien->jenis_kelamin = $request->jenis_kelamin;
        $pasien->save();

        return response()->json([
            'success' => true,
            'message' => 'Data pasien berhasil diperbarui.',
        ]);
    }
}
