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
}
