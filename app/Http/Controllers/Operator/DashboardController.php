<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Pasien;
use App\Models\Kuisioner;


class DashboardController extends Controller
{
    public function index(){
        $user = User::where('role', 'tim peneliti')->count();
        $pasien = Pasien::count();
        $kuisioner = Kuisioner::count();

        return view('operator.dashboard', compact('user', 'pasien', 'kuisioner'));
    }
}
