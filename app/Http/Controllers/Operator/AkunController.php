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
            'role' => 'required|in:operator,tim peneliti',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return response()->json([
            'success' => true, // Ubah dari 'status' menjadi 'success'
            'message' => 'Akun berhasil ditambahkan',
        ]);
        
    }
}
