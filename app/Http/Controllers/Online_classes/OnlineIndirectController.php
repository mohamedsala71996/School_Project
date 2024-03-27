<?php

namespace App\Http\Controllers\Online_classes;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\OnlineIndirect;
use Illuminate\Http\Request;

class OnlineIndirectController extends Controller
{
    public function index()
    {

        $OnlineIndirect = OnlineIndirect::where("created_by", auth()->user()->email)->get();

        return view("pages.online_classes.index", compact("OnlineIndirect"));
    }

    public function create()
    {
        $Grades = Grade::all();
        return view("pages.online_classes.add", compact("Grades"));
    }

    public function store(Request $request)
    {
        OnlineIndirect::create([
            'Grade_id' => $request->Grade_id,
            'Classroom_id' => $request->Classroom_id,
            'section_id' => $request->section_id,
            'created_by' => auth()->user()->email,
            'meeting_id' => $request->meeting_id,
            'topic' => $request->topic,
            'start_at' => $request->start_time,
            'duration' => $request->duration,
            'password' => $request->password,
            'start_url' => $request->start_url,
            'join_url' => $request->join_url
        ]);
        toastr()->success(trans('messages.success'));
        return redirect()->route('OnlineIndirect.index');
    }

    public function show(OnlineIndirect $onlineIndirect)
    {
        //
    }

    public function edit(OnlineIndirect $onlineIndirect)
    {
        //
    }

    public function update(Request $request, OnlineIndirect $onlineIndirect)
    {
        //
    }

    public function destroy(Request $request)
    {
        OnlineIndirect::destroy($request->id);
        toastr()->success(trans('messages.Delete'));
        return redirect()->route('OnlineIndirect.index');
    }
}
