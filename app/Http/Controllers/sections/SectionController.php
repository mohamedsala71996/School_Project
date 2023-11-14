<?php

namespace App\Http\Controllers\sections;

use App\Http\Requests\StoreSectionRequest;
use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Classroom;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SectionController extends Controller
{


  public function index()
  {

    $teachers = Teacher::all();
    $grades = Grade::with("section")->get();
    $grades_all = Grade::get();
    return view("pages.Sections.Sections", compact('grades', 'grades_all', 'teachers'));
  }


  public function create()
  {
  }

  public function store(StoreSectionRequest $request)
  {
    $validated = $request->validated();
    $sections = Section::create([
      'Name' => ["en" => $request->Name_Section_En, 'ar' => $request->Name_Section_Ar],
      'status' => 1,
      'Grade_id' => $request->Grade_id,
      'Class_id' => $request->Class_id,

    ]);
    $sections->teachers()->attach($request->teacher_id);
    session()->flash('add', trans('messages.success'));
    return redirect()->route('section.index');
  }


  public function show($id)
  {

  }


  public function edit($id)
  {

  }


  public function update(StoreSectionRequest $request)
  {
    $validated = $request->validated();
    if ($request->Status) {
      $section = Section::where("id", $request->id)->first();
      $section->update([
        'Name' => ["en" => $request->Name_Section_Ar, "ar" => $request->Name_Section_En],
        'Grade_id' => $request->Grade_id,
        'Class_id' => $request->Class_id,
        'status' => 1,
      ]);
    } else {
      $section = Section::where("id", $request->id)->first();
      $section->update([
        'Name' => ["en" => $request->Name_Section_Ar, "ar" => $request->Name_Section_En],
        'Grade_id' => $request->Grade_id,
        'Class_id' => $request->Class_id,
        'status' => 0,
      ]);
    };

    if (isset($request->teacher_id)) {
      $section->teachers()->sync($request->teacher_id);
    } else {
      $section->teachers()->sync(array());
    }
    session()->flash('add', trans('messages.Update'));
    return redirect()->route('section.index');
  }


  public function destroy(Request $request, $id)
  {
    Section::where("id", $request->id)->delete();
    session()->flash('add', trans('messages.Delete'));
    return redirect()->route('section.index');
  }

  public function classes($id)
  {
    $Classroom = Classroom::where('Grade_id', $id)->pluck('Name', 'id');
    return $Classroom;
  }
}
