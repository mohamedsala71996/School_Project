<?php

namespace App\Http\Controllers\Parent\dashboard;

use App\Http\Controllers\Controller;
use App\Models\My_Parent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class parentprofileController extends Controller
{

    public function index()
    {
        $information = My_Parent::findOrFail(auth()->user()->id);

        return view("pages.parents.profile", compact("information"));
    }


    public function update(Request $request)
    {

        if ($request->password != null) {
            My_Parent::findOrFail(auth()->user()->id)->update([

                'Name_Father' => ["en" => $request->Name_en, "ar" => $request->Name_ar],
                'password' => Hash::make($request->password)
            ]);
        } else {
            My_Parent::findOrFail(auth()->user()->id)->update([

                'Name_Father' => ["en" => $request->Name_en, "ar" => $request->Name_ar],
            ]);
        }
        toastr()->success(trans('messages.success'));
        return redirect()->back();
    }
}
