<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;

class profileController extends Controller
{

    public function index()
    {
        $information = Teacher::findOrFail(auth()->user()->id);
        return view("pages.Teachers.dashboard.profile", compact("information"));
    }
    public function update(Request $request)
    {
        if ($request->password != null) {
            Teacher::findOrFail(auth()->user()->id)->update([

                'Name' => ["en" => $request->Name_en, "ar" => $request->Name_ar],
                'password' => Hash::make($request->password)
            ]);
        } else {
            Teacher::findOrFail(auth()->user()->id)->update([

                'Name' => ["en" => $request->Name_en, "ar" => $request->Name_ar],
            ]);
        }
        toastr()->success(trans('messages.success'));
        return redirect()->back();
    }
}
