<?php

namespace App\Http\Controllers;

use App\Models\Attandance;
use App\Models\Bed;
use App\Models\Nurse;
use App\Models\RequestService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class showDataController extends Controller
{
    //show dashboard
    public function dashboard()
    {
        $no = 1;
        $daystart = Carbon::now()->format('Y-m-d 00:00:00');
        $dayend = Carbon::now()->format('Y-m-d 23:59:59');
        $today = Carbon::now()->format('l j'. ' , ' .'h:i A');

        $attendance = Attandance::whereBetween('created_at', [$daystart, $dayend])
        ->whereRaw('TIME(created_at) = TIME(updated_at)')
        ->orderByDesc('id')->get();
        $nurseinfo = Nurse::get();


        return view('dashboard')->with(['nurseAttendance' => $attendance, 'no' => $no, 'nurseinfo' => $nurseinfo, 'todayTime' => $today]);
    }

    //show nurse
    public function showNurse()
    {
        $nurse = Nurse::orderByDesc('id')->get();
        $no = 1;
        return view('nurse')->with(['nurses' => $nurse, 'no' => $no]);
    }

    //show beds
    public function showBed()
    {
        $bed = Bed::get();
        return view('bed', ['bed' => $bed]);
    }
    
    //show attendance
    public function attendanceRecord()
    {
        $no = 1;
        $attendance = Attandance::orderByDesc('id')->get();
        $nurseinfo = Nurse::get();

        return view('attendance')->with(['nurseAttendance' => $attendance, 'no' => $no, 'nurseinfo' => $nurseinfo]);
    }

    //show request
    public function showRequest()
    {
        $request = RequestService::get();
        $no = 1;
        return view('requestService', ['requests' => $request, 'no' => $no]);
    }
}
