<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\Section;
use App\Models\Grade;
use App\Models\Attendance;

class StudentsTeacherController extends Controller
{

    public function index()
    {
        $ids = DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck("section_id");
        $students = Student::whereIn("section_id", $ids)->get();
        return view("pages.Teachers.dashboard.students.index", compact("students"));
    }

    public function Sections_method()
    {
        $ids = DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck("section_id");
        $sections = Section::whereIn("id", $ids)->get();
        return view("pages.Teachers.dashboard.sections.index", compact("sections"));
    }

    public function attendance()
    {
        $ids = DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck("section_id");
        $sections = Section::whereIn("id", $ids)->get();
        $grades = Grade::with("section")->get();
        return view("pages.Teachers.dashboard.attendance.sections", compact("grades", "sections"));
    }

    public function attendanceShow($id)
    {
        $student = student::where("section_id", $id)->with("Attendance")->get();
        return view("pages.Teachers.dashboard.attendance.index", compact("student"));
    }

    public function store_attendance(Request $request)
    {
        $status_all = $request->input('status');
        foreach ($status_all as $studentId  => $Status_all) {
            if ($Status_all == 1) {
                $status = true;
            } else {
                $status = false;
            }

            Attendance::updateOrcreate([
                'student_id' => $studentId,
                'attendence_date' => date('Y-m-d'),
            ], [

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
        return redirect()->back();
    }

    public function attendance_report(Request $request)
    {
        $ids = DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck("section_id");
        $students = Student::whereIn("section_id", $ids)->get();
        return view("pages.Teachers.dashboard.attendance.attendance_report", compact("students"));
    }

    public function attendance_report_show(Request $request)
    {
        $student_id = $request->student_id;
        $from = $request->from;
        $to = $request->to;
        $ids = DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck("section_id");
        $students = Student::whereIn("section_id", $ids)->get();
        $request->validate([
            'from'  => 'required|date|date_format:Y-m-d',
            'to' => 'required|date|date_format:Y-m-d|after_or_equal:from'
        ], [
            'to.after_or_equal' => 'تاريخ النهاية لابد ان يكون اكبر من تاريخ البداية او يساويه',
            'from.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
            'to.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
        ]);

        if ($request->student_id == 0) {

            $student_attendance = Attendance::whereIn("student_id", $ids)->whereBetween("attendence_date", [$from, $to])->get();
            return view("pages.Teachers.dashboard.attendance.attendance_report", compact("student_attendance", "students", "student_id", "from", "to"));
        } else {
            $student_attendance = Attendance::where("student_id", $student_id)->whereBetween("attendence_date", [$from, $to])->get();

            return view("pages.Teachers.dashboard.attendance.attendance_report", compact("student_attendance", "students", "student_id", "from", "to"));
        }
    }
}
