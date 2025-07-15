<?php

namespace App\Http\Controllers\TimPeneliti;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

use App\Models\HasilAnalisis;

class HasilAnalisisConroller extends Controller
{
    public function index (){
        
        return view('tim.hasil.index');
    }

    public function data (){
        $data = HasilAnalisis::with('pasien')->get();
        return DataTables::of($data)->make(true);
    }

    public function show ($id){
        $data = HasilAnalisis::with('pasien')->findOrFail($id);
        return response()->json($data);
    }
}
