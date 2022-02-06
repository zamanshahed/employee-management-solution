<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->is_owner==1){
            return redirect()->route('owner.home');
        }else{
            return view('home');
        }
        
    }

    public function ownerIndex()
    {
        $users = DB::table('users')->get();
        return view('admin.admindash', compact('users'));
    }    
    
}
