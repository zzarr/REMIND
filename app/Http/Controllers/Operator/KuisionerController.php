<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kuisioner;

class KuisionerController extends Controller
{
    public function index(){
        return view('operator.kuisioner.index');
    }

    public function data(){
        $data = Kuisioner::all();
        return datatables()->of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function store(Request $request){
        $request->validate([
            'pertanyaan' => 'required',
            'is_positive' => 'required'
        ]);

        if ($request->is_positive == 'true') {
            $is_positive = 1;
        } else {
            $is_positive = 0;
        }

        Kuisioner::create([
            'pertanyaan' => $request->pertanyaan,
            'is_positive' => $is_positive
        ]);

        return response()->json([
            'success' => true, // Ubah dari 'status' menjadi 'success'
            'message' => 'Akun berhasil ditambahkan',
        ]);
    }
}
