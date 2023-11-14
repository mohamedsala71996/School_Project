<?php

namespace App\Http\Controllers\Students\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class profileStudentController extends Controller
{

    public function index()
    {

        $information = Student::findOrFail(auth()->user()->id);

        return view("pages.students.dashboard.profile", compact("information"));
    }
    public function update(Request $request)
    {

        if ($request->password != null) {
            Student::findOrFail(auth()->user()->id)->update([

                'Name' => ["en" => $request->Name_en, "ar" => $request->Name_ar],
                'password' => Hash::make($request->password)
            ]);
        } else {
            Student::findOrFail(auth()->user()->id)->update([

                'Name' => ["en" => $request->Name_en, "ar" => $request->Name_ar],
            ]);
        }
        toastr()->success(trans('messages.success'));
        return redirect()->back();
    }
}
