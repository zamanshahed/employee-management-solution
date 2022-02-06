<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    //add employee
    public function addEmployee()
    {
        return view('admin.employeereg');
    }

    public function saveEmployee(Request $request)
    {
        // basic validation 
        $validated = $request->validate([
            'name' => 'required|unique:users|max:255',
            'email' => 'required|unique:users|max:255',
            'password' => 'required|min:5',
            // 'password_confirmation' => 'required|min:5',
        ]);

        if ($request->password === $request->password_confirmation) {

            // database posting
            User::insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),                
                'created_at' => Carbon::now(),
            ]);
        }else{
            return redirect()->route('employee.add')->with('message', 'Both passwords must be same !');
        }        
        // successfull Employee addition
        return redirect()->route('employee.add')->with('message', 'New Employee Added !');
    }
}
