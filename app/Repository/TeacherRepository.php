<?php

namespace App\Repository;

use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teacher;
use App\Repository\TeacherRepositoryInterface;

class TeacherRepository implements TeacherRepositoryInterface
{

    public function getAllTeachers()
    {
        return  Teacher::all();
    }


    public function getGender()
    {
        return  Gender::all();
    }


    public function getSpecialization()
    {

        return  Specialization::all();
    }

    
    public function addTeachers($request)
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


    public function getOneTeacher($id)
    {
        return  Teacher::find($id);
    }


    public function updateTeacher($request, $id)
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


    public function deleteTeacher($request)
    {
        Teacher::find($request->id)->delete();
        session()->flash('add', trans('messages.Delete'));
        return redirect()->route('teacher.index');
    }
};
