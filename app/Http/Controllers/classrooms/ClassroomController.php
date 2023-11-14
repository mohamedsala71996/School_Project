<?php

namespace App\Http\Controllers\classrooms;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassroomRequest;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{

  public function index()
  {
    $grades = Grade::get();
    $classrooms = Classroom::get();
    return view("pages.My_Classes.My_Classes", compact("classrooms", "grades"));
  }

  public function create()
  {
  }

  public function store(StoreClassroomRequest $request)
  {



    $validated =  $request->validated();
    $List_Classes = $request->List_Classes;

    foreach ($List_Classes as $List_Classes) {
      Classroom::create([

        "Name" => ["en" => $List_Classes['Name_class_en'], "ar" => $List_Classes['Name_class_ar']],
        "Grade_id" => $List_Classes['Grade_id']

      ]);
    }
    session()->flash('add', trans('messages.success'));

    return redirect()->route('classroom.index');
  }


  public function show($id)
  {
  }

  public function edit($id)
  {
  }


  public function update(Request $request, $id)
  {

    $validated = $request->validate([
      'Name_class_ar' =>  'required|unique:classrooms,Name->ar,' . $id,
      'Name_class_en' => 'required|unique:classrooms,Name->en,' . $id,
      'Grade_id' => 'required',
    ], [
      'Name_class_ar.required' => trans("validation.required"),
      'Name_class_en.required' => trans("validation.required"),
      'Name_class_en.unique' => trans("validation.unique"),
      'Name_class_en.unique' => trans("validation.unique"),
      'Grade_id.required' => trans("validation.required"),
    ]);

    Classroom::where('id', $id)->update([

      'Name' => ["en" => $request->Name_class_en, "ar" => $request->Name_class_ar],
      'Grade_id' => $request->Grade_id

    ]);
    session()->flash('add', trans('messages.Update'));

    return redirect()->route('classroom.index');
  }

  public function destroy($id)
  {
    $Classroom = Classroom::findOrFail($id);
    $Classroom->delete();

    session()->flash('add', trans('messages.Delete'));

    return redirect()->route('classroom.index');
  }


  public function removeMulti(Request $request)
  {

    $ids = $request->ids;
    Classroom::whereIn('id', explode(",", $ids))->delete();
    return response()->json(['status' => true, 'message' => "Student successfully removed."]);
  }

  public function search(Request $request)
  {
    $grades = Grade::get();
    $Grade_id = $request->Grade_id;
    $classroom_search = Classroom::where("Grade_id", $request->Grade_id)->get();
    return view("pages.My_Classes.My_Classes", compact("classroom_search", "grades", "Grade_id"));
  }
}
