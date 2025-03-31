<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Models\User;

class AkunController extends Controller
{
    public function index(){
        return view('operator.akun.index');
    }

    public function data(){
        $data = User::get();

        return DataTables::of($data)->make(true);
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);


        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'success' => true, // Ubah dari 'status' menjadi 'success'
            'message' => 'Akun berhasil ditambahkan',
        ]);
        
    }

    public function edit($id){
        $data = User::findOrFail($id);
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        // ✅ 1. Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6|confirmed', // "confirmed" harus cocok dengan confirm_password
        ]);
    
        // ✅ 2. Cek apakah user ada
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Akun tidak ditemukan',
            ], 404);
        }
    
        // ✅ 3. Update data user
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
    
        // ✅ 4. Update password hanya jika diisi
        if (!empty($validatedData['password'])) {
            $user->password = bcrypt($validatedData['password']);
        }
    
        $user->save();
    
        return response()->json([
            'success' => true,
            'message' => 'Akun berhasil diperbarui',
        ]);
    }

        public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'Akun berhasil dihapus.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus akun.',
            ], 500);
        }
    }

    
}
