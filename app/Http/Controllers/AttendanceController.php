<?php

namespace App\Http\Controllers;

use App\Models\AttendanceTracker;
use App\Models\User;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AttendanceController extends Controller
{
    public function index()
    {
        $created = Auth::user()->is_owner;


        $result  = Carbon::now()->addHour(6)->isoFormat('Y-MM-DD HH:mm:ss');

        $date = Carbon::now()->addHour(6)->isoFormat('D MMMM, YYYY');
        return view('user.attendance', compact('date', 'created', 'result'));
    }

    public function allAttendance()
    {

        $items = AttendanceTracker::all();

        return view('admin.allattendance', compact('items'));
    }


    public function checkIn()
    {
        $user_id = Auth::user()->id;
        // get current local date
        $date = Carbon::now()->isoFormat('DD-MM-Y');

        // get current local time
        $time =  Carbon::now()->addHour(6)->isoFormat('HH:mm A');

        // database posting
        AttendanceTracker::insert([
            'user_id' => $user_id,
            'date' => $date,
            'check_in' => $time,
            'created_at' => Carbon::now(),
        ]);
        
        $updateUser = User::find(Auth::user()->id)->update([
            // after check out done!
            'is_owner' => -1,
        ]);
        
        return redirect()->route('home');
    }

    public function checkOut()
    {
        
        $user_update = Auth::user()->updated_at;
        $tracker_id = Auth::user()->tracker_finder->id;
        $date = Carbon::now()->isoFormat('DD-MM-Y');
        // get current local time
        $time =  Carbon::now()->addHour(6)->isoFormat('HH:mm A');        

        // office hour calculation

        $actual_start_at = $user_update;
        $actual_end_at = Carbon::now();
        $result = $actual_end_at->diffInSeconds($actual_start_at, true);
        $result = CarbonInterval::seconds($result)->cascade();


        $update = AttendanceTracker::find($tracker_id)->update([
            'check_out' => $time,
            'spent_hours' => $result,
        ]);

        $updateUser = User::find(Auth::user()->id)->update([
            // after check out done!
            'is_owner' => null,
        ]);


        return redirect()->route('home');
    }
}
