<?php

namespace App\Http\Controllers\Parent\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Fee_invoice;
use App\Models\ReceiptStudent;
use App\Models\Result;
use App\Models\Student;
use Illuminate\Http\Request;

class SonController extends Controller
{

    public function index()
    {
        $sons = Student::where("parent_id", auth()->user()->id)->get();
        return view('pages.parents.sons.index', compact("sons"));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id_student)
    {
        $ids = Student::where("parent_id", auth()->user()->id)->pluck("id");
        foreach ($ids as $id) {
            if ($id == $id_student) {
                $results = Result::where("student_id", $id_student)->get();
                return view('pages.parents.sons.results_show', compact("results"));
            } else {

                toastr()->error("يوجد خطأ");
                return redirect()->back();
            }
        }
    }


    public function attendance_report()
    {
        $ids = Student::where("parent_id", auth()->user()->id)->pluck("id");
        $students = Student::whereIn("id", $ids)->get();
        return view("pages.parents.attendance.index", compact("students"));
    }
    public function attendance_report_show(Request $request)
    {
        $student_id = $request->student_id;
        $from = $request->from;
        $to = $request->to;
        $ids = Student::where("parent_id", auth()->user()->id)->pluck("id");
        $students = Student::whereIn("id", $ids)->get();
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
            return view("pages.parents.attendance.index", compact("student_attendance", "students", "student_id", "from", "to"));
        } else {
            $student_attendance = Attendance::where("student_id", $student_id)->whereBetween("attendence_date", [$from, $to])->get();
            return view("pages.parents.attendance.index", compact("student_attendance", "students", "student_id", "from", "to"));
        }
    }


    public function feesInvoices()
    {
        $ids = Student::where("parent_id", auth()->user()->id)->pluck("id");
        $Fee_invoices = Fee_invoice::whereIn("student_id", $ids)->get();
        return view("pages.parents.fees.index", compact("Fee_invoices"));
    }

    public function receipt_sons($id_student)
    {
        $ids = Student::where("parent_id", auth()->user()->id)->pluck("id");
        foreach ($ids as $id) {
            if ($id == $id_student) {
                $receipt_students = ReceiptStudent::where("student_id", $id)->get();
                return view("pages.parents.Receipt.index", compact("receipt_students"));
            } else {
                toastr()->error("يوجد خطأ");
                return redirect()->back();
            }
        }
    }
}
