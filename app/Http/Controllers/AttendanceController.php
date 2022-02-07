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
        $created = 0;
        if (AttendanceTracker::find(Auth::user()->id)) {
            $created = 1;
        }

        // $actual_start_at = Carbon::parse('2017-05-01 13:00:00');
        // $actual_end_at = Carbon::parse('2017-05-01 17:00:00');
        // $result = $actual_end_at->diffInSeconds($actual_start_at, true);
        // $result = CarbonInterval::seconds($result)->cascade();

        $result  = Carbon::now()->addHour(6)->isoFormat('Y-MM-DD HH:mm:ss');

        $date = Carbon::now()->addHour(6)->isoFormat('D MMMM, YYYY');
        return view('user.attendance', compact('date', 'created', 'result'));
    }

    public function checkIn()
    {
        $user_id = Auth::user()->id;
        // get current local date
        // $date = Carbon::now()->isoFormat('DD-MM-Y');
        $date = Carbon::now();
        // get current local time
        // $time =  Carbon::now()->addHour(6)->isoFormat('HH:mm A');
        $time = Carbon::now();
        // database posting
        AttendanceTracker::insert([
            'user_id' => $user_id,
            'date' => $date,
            'check_in' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);
        return redirect()->route('home');
    }

    public function checkOut()
    {
        $user_id = Auth::user()->id;
        $date = Carbon::now()->isoFormat('DD-MM-Y');

        // office hour calculation
        // $actual_start_at = Carbon::parse('2017-05-01 13:00:00');
        // $actual_end_at = Carbon::now()->addHour(6)->isoFormat('Y-MM-DD HH:mm:ss');
        // $result = $actual_end_at->diffInSeconds($actual_start_at, true);
        // $result = CarbonInterval::seconds($result)->cascade();

        $timeNow = Carbon::now();

        $actual_start_at = AttendanceTracker::where('user_id', $user_id)->first()->check_in;
        $actual_end_at = $timeNow;
        $result = $actual_end_at->diffInSeconds($actual_start_at, true);
        $result = CarbonInterval::seconds($result)->cascade();

        $update = AttendanceTracker::where('user_id', $user_id)->first()->update([
            'check_out' => $timeNow,
            'spent_hours' => $result,
        ]);

        return redirect()->route('home');
    }
}
