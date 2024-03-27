<?php

namespace App\Http\Controllers\Students;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\storeStudentRequest;
use App\Models\Classroom;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\My_Parent;
use App\Models\Section;
use App\Models\Nationalities;
use App\Models\Image;
use App\Models\Student;
use App\Models\Type_Blood;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::get();
        return view("pages.Students.index", compact("students"));
    }
    public function create()
    {
        $data["Type_Blood"] = Type_Blood::get();
        $data["Nationalities"] = Nationalities::get();
        $data["Gender"] = Gender::get();
        $data["Grade"] = Grade::get();
        $data["Classroom"] = Classroom::get();
        $data["My_Parent"] = My_Parent::get();
        return view("pages.Students.add", $data);
    }

    public function store(storeStudentRequest $request)
    {
        DB::beginTransaction();
        try {
            $students = new Student();
            $students->Name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $students->email = $request->email;
            $students->password = Hash::make($request->password);
            $students->gender_id = $request->gender_id;
            $students->nationalitie_id = $request->nationalitie_id;
            $students->blood_id = $request->blood_id;
            $students->Date_Birth = $request->Date_Birth;
            $students->Grade_id = $request->Grade_id;
            $students->Classroom_id = $request->Classroom_id;
            $students->section_id = $request->section_id;
            $students->parent_id = $request->parent_id;
            $students->academic_year = $request->academic_year;
            $students->save();

            if ($request->hasFile('photos')) {
                $file = $request->file('photos');
                $Student = Student::latest()->first();
                foreach ($file as $file) {
                    $fileName = $file->getClientOriginalName();
                    Image::create([
                        "file_name" => $fileName,
                        "imageable_id" => $Student->id,
                        "imageable_type" => "App\\Models\\Student",
                    ]);
                    $file->storeAs('Polymorphic/' . $Student->Name, $fileName, 'photos');
                }
            }
            DB::commit();
            session()->flash('add', trans('messages.success'));
            return redirect()->route('student.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $Student = Student::findOrFail($id);
        return view("pages.Students.show", compact("Student"));
    }

    public function edit($id)
    {
        $Student = Student::findOrFail($id);
        $data["Type_Blood"] = Type_Blood::get();
        $data["Nationalities"] = Nationalities::get();
        $data["Gender"] = Gender::get();
        $data["Grade"] = Grade::get();
        $data["Classroom"] = Classroom::get();
        $data["My_Parent"] = My_Parent::get();
        $data["Section"] = Section::get();
        return view("pages.Students.edit", $data, compact("Student"));
    }

    public function update(storeStudentRequest $request, string $id)
    {
        $students = Student::findOrFail($request->id);
        $students->Name = ['en' => $request->name_en, 'ar' => $request->name_ar];
        $students->email = $request->email;
        $students->password =  Hash::make($request->password);
        $students->gender_id = $request->gender_id;
        $students->nationalitie_id = $request->nationalitie_id;
        $students->blood_id = $request->blood_id;
        $students->Date_Birth = $request->Date_Birth;
        $students->Grade_id = $request->Grade_id;
        $students->Classroom_id = $request->Classroom_id;
        $students->section_id = $request->section_id;
        $students->parent_id = $request->parent_id;
        $students->academic_year = $request->academic_year;
        $students->save();
        session()->flash('add', trans('messages.Update'));
        return redirect()->route('student.index');
    }

    public function destroy(Request $request, $id)
    {
        $Student = Student::findOrFail($request->id);
        $Student->delete();
        session()->flash('add', trans('messages.Delete'));
        return redirect()->route('student.index');
    }

    public function Get_Sections($id)
    {
        $Section = Section::where("Class_id", $id)->pluck("Name", "id");
        return $Section;
    }

    public function upload_files(Request $request)
    {
        if ($request->hasFile('photos')) {
            $file = $request->file('photos');
            foreach ($file as $file) {
                $fileName = $file->getClientOriginalName();
                Image::create([
                    "file_name" => $fileName,
                    "imageable_id" => $request->student_id,
                    "imageable_type" => "App\\Models\\Student",
                ]);
                $file->storeAs('Polymorphic/' . $request->student_name, $fileName, 'photos');
            }
            return redirect()->back();
        }
    }

    public function delete_files(Request $request)
    {
        $fileName = Image::where("id", $request->id)->pluck("file_name");
        $imageable_id = Image::where("id", $request->id)->pluck("imageable_id");
        $student_name = Student::where("id", $imageable_id)->pluck("Name");
        Image::destroy($request->id);
        Storage::disk('photos')->delete('Polymorphic/' . $student_name[0] . '/' . $fileName[0]);
        return redirect()->back();
    }

    public function downloadFile($student_name, $file_name)
    {
        $myFile = public_path("files/Polymorphic/" . $student_name . "/" . $file_name);
        return response()->download($myFile);
    }
}
