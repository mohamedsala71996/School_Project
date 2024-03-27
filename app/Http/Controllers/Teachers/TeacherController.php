<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Http\Requests\storeTeacherRequest;
use App\Models\Teacher;
use App\Models\Gender;
use App\Models\Specialization;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $AllTeachers = Teacher::all();
        return view("pages.Teachers.Teachers", compact("AllTeachers"));
    }

    public function create()
    {
        $genders = Gender::all();
        $Specialization = Specialization::all();

        return view("pages.Teachers.create", compact("genders", "Specialization"));
    }

    public function store(storeTeacherRequest $request)
    {
        $validated = $request->validated();
        Teacher::create([
            'email' => $request->Email,
            'password' => $request->password,
            'Name' => ["en" => $request->Name_en, "ar" => $request->Name_ar],
            'Specialization_id' => $request->Specialization_id,
            'Gender_id' => $request->Gender_id,
            'Joining_Date' => $request->Joining_Date,
            'Address' => $request->Address,
        ]);
        session()->flash('add', trans('messages.success'));
        return redirect()->route('teacher.index');
    }

    public function show(Teacher $teacher)
    {
        //
    }

    public function edit($id)
    {

        $teacher = Teacher::find($id);
        $genders = Gender::all();
        $Specialization = Specialization::all();

        return view("pages.Teachers.Edit", compact("genders", "Specialization", "teacher"));
    }

    public function update(storeTeacherRequest $request, $id)
    {
        $teacher = Teacher::find($id);
        $teacher->update([
            'email' => $request->email,
            'password' => $request->password,
            'Name' => ["en" => $request->Name_en, "ar" => $request->Name_ar],
            'Specialization_id' => $request->Specialization_id,
            'Gender_id' => $request->Gender_id,
            'Joining_Date' => $request->Joining_Date,
            'Address' => $request->Address,
        ]);
        session()->flash('add', trans('messages.success'));
        return redirect()->route('teacher.index');
    }

    public function destroy(Request $request)
    {
        Teacher::find($request->id)->delete();
        session()->flash('add', trans('messages.Delete'));
        return redirect()->route('teacher.index');
    }
}
