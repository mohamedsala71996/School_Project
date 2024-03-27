<?php

namespace App\Http\Controllers\Students\Attendance;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Student;

class AttendanceController extends Controller
{
    public function index()
    {
        $grades = Grade::with("section")->get();
        return view("pages.Attendance.Sections", compact("grades"));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $status_all = $request->input('status');
        foreach ($status_all as $studentId  => $Status_all) {

            if ($Status_all == 1) {
                $status = true;
            } else {
                $status = false;
            }

            Attendance::create([

                'student_id' => $studentId,
                'Grade_id' => $request->grade_id,
                'classroom_id' => $request->classroom_id,
                'section_id' => $request->section_id,
                'teacher_id' => "1",
                'attendence_date' => date('Y-m-d'),
                'attendence_status' => $status,
            ]);
        }
        toastr()->success(trans('messages.success'));
        return redirect()->route('Attendance.index');
    }

    public function show($id)
    {
        $student = Student::where("section_id", $id)->with("Attendance")->get();
        return view("pages.Attendance.index", compact("student"));
    }

    public function edit(Attendance $attendance)
    {
        //
    }

    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    public function destroy(Attendance $attendance)
    {
        //
    }
}
