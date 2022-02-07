<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AttendanceController extends Controller
{
    public function index(){
        
        $date = Carbon::now()->isoFormat('dd MMMM, Y');
        return view('user.attendance', compact('date'));
    }
}
