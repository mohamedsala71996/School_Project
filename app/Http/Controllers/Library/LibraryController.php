<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\library;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LibraryController extends Controller
{
    public function index()
    {
        $Library = library::all();

        return view("pages.Library.index", compact("Library"));
    }

    public function create()
    {
        $grades = Grade::all();

        return view("pages.Library.create", compact("grades"));
    }

    public function store(Request $request)
    {
        $file_name = $request->file('file_name')->getClientOriginalName();
        library::create([
            "title" => $request->title,
            "Grade_id" => $request->Grade_id,
            "Classroom_id" => $request->Classroom_id,
            "section_id" => $request->section_id,
            "file_name" => $file_name,
            "teacher_id" => 1,
        ]);

        $request->file('file_name')->storeAs("books", $file_name, 'books');
        toastr()->success(trans('messages.success'));
        return redirect()->route('Library.index');
    }

    public function show(library $library)
    {
        //
    }

    public function edit($id)
    {
        $grades = Grade::all();
        $book = library::where("id", $id)->first();

        return view("pages.Library.edit", compact("grades", "book"));
    }

    public function update(Request $request)
    {
        $file = $request->file("file_name");
        if ($file) {

            $file_name = $request->file('file_name')->getClientOriginalName();
            library::where("id", $request->id)->update([
                "title" => $request->title,
                "Grade_id" => $request->Grade_id,
                "Classroom_id" => $request->Classroom_id,
                "section_id" => $request->section_id,
                "file_name" => $file_name,
                "teacher_id" => 1,
            ]);
            Storage::disk('books')->delete('books/' . $request->old_file);

            $request->file('file_name')->storeAs("books", $file_name, 'books');
        } else {

            library::where("id", $request->id)->update([
                "title" => $request->title,
                "Grade_id" => $request->Grade_id,
                "Classroom_id" => $request->Classroom_id,
                "section_id" => $request->section_id,
                "teacher_id" => 1,
            ]);
        }
        toastr()->success(trans('messages.success'));
        return redirect()->route('Library.index');
    }

    public function destroy(Request $request)
    {

        library::destroy($request->id);
        Storage::disk('books')->delete('books/' . $request->file_name);
        toastr()->success(trans('messages.Delete'));
        return redirect()->back();
    }

    public function download_file($name)
    {
        $myFile = public_path("books/books/" . $name);

        return response()->download($myFile);
    }
}
