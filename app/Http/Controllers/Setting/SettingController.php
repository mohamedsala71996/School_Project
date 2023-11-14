<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{

    public function index()
    {
        $collection = Setting::all();
        $setting['setting'] = $collection->flatMap(
            function ($collection) {
                return [$collection->key => $collection->value];
            }
        );
        return view("pages.Setting.index", $setting);
    }



    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }



    public function show(Setting $setting)
    {
        //
    }


    public function edit(Setting $setting)
    {
        //
    }


    public function update(Request $request)
    {
        $info = $request->except('_method', '_token', 'logo');
        foreach ($info as $key => $value) {
            Setting::where("key", $key)->update(["value" => $value]);
        }
        if ($request->file("logo")) {
            $file_name = $request->file("logo")->getClientOriginalName();
            Storage::disk('logo')->delete('logo/' . $request->old_logo);
            $request->file('logo')->storeAs("logo", $file_name, 'logo');
            Setting::where("key", "logo")->update(["value" => $file_name]);
        }
        toastr()->success(trans('messages.Update'));
        return back();
    }


    public function destroy(Setting $setting)
    {
        //
    }
}
