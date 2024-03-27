<?php

namespace App\Http\Controllers\Students\Graduated;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;

class GraduatedController extends Controller
{
    public function index()
    {
        $Students = Student::onlyTrashed()->get();
        return view("pages.Students.Graduated.index", compact("Students"));
    }

    public function create()
    {
        $Grades = Grade::all();
        return view("pages.Students.Graduated.Create", compact("Grades"));
    }

    public function store(Request $request)
    {
        $Students = Student::where("Grade_id", $request->Grade_id)->where("Classroom_id", $request->Classroom_id)->where("section_id", $request->section_id)->get();
        if ($Students->count() == 0) {
            session()->flash('wrong', trans('messages.error'));
            return redirect()->route('graduated.create');
        }

        foreach ($Students as $Student) {
            $Student->delete();
        }
        session()->flash('add', trans('messages.success'));
        return redirect()->route('graduated.create');
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }


    public function update(Request $request,  $id)
    {
        $Student = Student::onlyTrashed()->findOrFail($request->id);
        $Student->restore();
        session()->flash('add', trans('messages.success'));
        return redirect()->route('graduated.index');
    }


    public function destroy(Request $request, $id)
    {
        $Student = Student::onlyTrashed()->findOrFail($request->id);
        $Student->forceDelete();
        session()->flash('add', trans('messages.success'));
        return redirect()->route('graduated.index');
    }
}
