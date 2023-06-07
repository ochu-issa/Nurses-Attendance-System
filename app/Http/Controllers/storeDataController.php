<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddNurseRequest;
use App\Http\Requests\AttendanceRequest;
use App\Http\Requests\bedRequest;
use App\Models\Attandance;
use App\Models\Bed;
use App\Models\Nurse;
use App\Models\RequestService;
use Illuminate\Http\Request;

class storeDataController extends Controller
{
    //add nurse
    public function addNurse(AddNurseRequest $request)
    {
        $request->validated($request->all());

        $firstNameInitials = substr($request->f_name, 0, 2);
        $lastNameInitials = substr($request->l_name, 0, 2);
        $randomNumber = mt_rand(1000, 9999);
        $nurse_number = strtoupper($firstNameInitials . $lastNameInitials . $randomNumber);
        //dd($nurse_number);
        Nurse::create([
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'gender' => $request->gender,
            'phone_number' => $request->phone_number,
            'nurse_number' => $nurse_number,
        ]);

        return back()->with('success', 'Nurse is created successfully!');
    }

    //delete nurse
    public function deleteNurse(Request $request)
    {
        $delete = Nurse::find($request->nurse_id);
        $delete->Attandance()->delete();
        $delete->delete();
        return back()->with('success', 'Nurse is deleted successfully!');

    }

    //attendance function
    public function nurseAttendance(AttendanceRequest $request)
    {
        $request->validated($request->all());
        $nurse = Nurse::where('nurse_number', $request->nurse_number)->first();

        if ($request->action == 'signin') {
            //perform sign in action
            if ($nurse) {
                $nurse_today = Attandance::where('nurse_id', $nurse->id)
                    ->whereDate('created_at', \today())
                    ->exists();
                if (!$nurse_today) {
                    Attandance::create([
                        'nurse_id' => $nurse->id,
                    ]);
                    return back()->with('success', 'Welcome! You have been logged in.');
                } else {
                    return back()->with('error', 'Nurse has already logged in today.');
                }
            } else {
                return back()->with('error', 'Invalid Nurse ID!');
            }
        } else if ($request->action == 'signout') {
            //perform sign out action
            if ($nurse) {
                $nurse_today = Attandance::where('nurse_id', $nurse->id)
                    ->whereDate('created_at', \today())
                    ->first();
                if ($nurse_today) {
                    if ($nurse_today->created_at == $nurse_today->updated_at) {
                        $nurse_today->update([
                            'updated_at' => \now(),
                        ]);
                        return back()->with('success', 'Bye Bye! see you tomorow.');
                    } else {
                        return back()->with('error', 'Nurse has already logged out today.');
                    }
                } else {
                    return back()->with('error', 'Please! login first!.');
                }
            } else {
                return back()->with('error', 'Invalid Nurse ID!');
            }
        }
    }

    //register bed
    public function addBed(bedRequest $request)
    {
        $request->validated($request->all());

        Bed::create(['bed_number' => $request->bed_number]);
        return back()->with('success', 'Bed is created successfully!');
    }

    //delete bed
    public function deleteBed(Request $request)
    {
        Bed::find($request->bed_id)->delete();
        return back()->with('success', 'Bed is deleted successfully!');

    }

    // sending request function
    public function sendingRequest($bed_number)
    {
        $bed = Bed::where('bed_number', $bed_number)->first();
        if ($bed) {
            $bed_number = $bed->bed_number;
            $currentDate = date('Y-m-d');

            $selectRequest = RequestService::where('bed_number', $bed_number)
                ->whereDate('created_at', $currentDate)
                ->first();

            if ($selectRequest) {
                if ($selectRequest->status == 0) {
                    $selectRequest->update([
                        'status' => 1,
                        'click_times' => $selectRequest->click_times + 1,
                    ]);
                    return response('on');
                } else {
                    $selectRequest->update(['status' => 0]);
                    return response('off');
                }
            } else {
                // Create a new request for the current date
                RequestService::create([
                    'bed_number' => $bed_number,
                    'click_times' => 1,
                ]);
                return response('success-on');
            }
        } else {
            return response('invalid');
        }
    }



}
