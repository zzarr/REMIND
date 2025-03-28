<?php

namespace App\Http\Controllers\TimPeneliti;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jawaban;

class DashboardController extends Controller
{
    public function index(){
        $pretest = Jawaban::where('jenis_test', 'pretest')->count();
        $posttest = Jawaban::where('jenis_test', 'posttest')->count();
        return view('tim.dashboard', compact('pretest', 'posttest'));
    }
}
