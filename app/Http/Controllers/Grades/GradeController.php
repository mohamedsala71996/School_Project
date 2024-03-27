<?php

namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGreadeRequest;
use App\Models\Classroom;
use App\Models\Grade;



class GradeController extends Controller
{
  public function index()
  {
    $grades = Grade::get();

    return view("pages.Grades.grade_list", compact("grades"));
  }

  public function create()
  {
  }

  public function store(StoreGreadeRequest $request)
  {
    $validated = $request->validated();
    $grade = new Grade;
    $grade->Name = ["en" => $request->name_en, "ar" => $request->name_ar];
    $grade->Notes = $request->notes;
    $grade->save();

    session()->flash('add', trans('messages.success'));

    return redirect()->route('grade.index');
  }

  public function show($id)
  {

  }

  public function edit($id)
  {

  }

  public function update(StoreGreadeRequest $request, $id)
  {

    $validated = $request->validated();
    Grade::where('id', $id)->update([

      'Name' => ["en" => $request->name_en, "ar" => $request->name_ar],
      'Notes' => $request->notes

    ]);
    session()->flash('add', trans('messages.Update'));

    return redirect()->route('grade.index');
  }


  public function destroy($id)
  {

    $classroom_counts = Classroom::where("Grade_id", $id)->count();
    if ($classroom_counts == 0) {
      $grade = Grade::findOrFail($id);
      $grade->delete();

      session()->flash('add', trans('messages.Delete'));

      return redirect()->route('grade.index');
    } else {

      session()->flash('relation', trans('messages.relation'));

      return redirect()->route('grade.index');
    }
  }
}
