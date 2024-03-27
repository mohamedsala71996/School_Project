<?php

namespace App\Http\Controllers\Students\Promotion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Promotion;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class PromotionController extends Controller
{
    public function index()
    {
        $Grades = Grade::get();
        return view("pages.Students.promotion.index", compact("Grades"));
    }

    public function create()
    {
        $Promotion = Promotion::all();
        return view("pages.Students.promotion.management", compact("Promotion"));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $Students = Student::where("Grade_id", $request->Grade_id)->where("Classroom_id", $request->Classroom_id)->where("section_id", $request->section_id)->where("academic_year", $request->academic_year)->get();
            if ($Students->count() == 0) {
                DB::commit();
                session()->flash('wrong', trans('messages.error'));
                return redirect()->route('promotion.index');
            }

            foreach ($Students as $Student) {
                $Student->update([
                    "Grade_id" => $request->Grade_id_new,
                    "Classroom_id" => $request->Classroom_id_new,
                    "section_id" => $request->section_id_new,
                    "academic_year" => $request->academic_year_new,
                ]);
                Promotion::updateOrCreate([
                    "student_id" => $Student->id,
                    "from_grade" => $request->Grade_id,
                    "from_Classroom" => $request->Classroom_id,
                    "from_section" => $request->section_id,
                    "academic_year" => $request->academic_year,
                    "to_grade" => $request->Grade_id_new,
                    "to_Classroom" => $request->Classroom_id_new,
                    "to_section" => $request->section_id_new,
                    "academic_year_new" => $request->academic_year_new,
                ]);
            }
            DB::commit();
            session()->flash('add', trans('messages.success'));
            return redirect()->route('promotion.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, string $id)
    {
    }

    public function destroy(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            if ($request->id == 1) {
                $Promotions = Promotion::all();
                $students_id = Promotion::all()->pluck("student_id");
                $students = Student::whereIn("id", $students_id)->get();
                foreach ($students as $students) {
                    $promotion = Promotion::where("student_id", $students->id)->first();
                    $students->update([
                        "Grade_id" => $promotion->from_grade,
                        "Classroom_id" => $promotion->from_Classroom,
                        "section_id" => $promotion->from_section,
                        "academic_year" => $promotion->academic_year,
                    ]);
                    $promotion->delete();
                }
                DB::commit();
                session()->flash('add', trans('messages.Delete'));
                return redirect()->route('promotion.create');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy_one(Request $request)
    {
        DB::beginTransaction();
        try {
            $Promotions = Promotion::where("id", $request->id)->first();
            $students = Student::where("id", $Promotions->student_id)->first();
            $students->update([
                "Grade_id" => $Promotions->from_grade,
                "Classroom_id" => $Promotions->from_Classroom,
                "section_id" => $Promotions->from_section,
                "academic_year" => $Promotions->academic_year
            ]);
            $Promotions->delete();
            DB::commit();
            session()->flash('add', trans('messages.Delete'));
            return redirect()->route('promotion.create');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
