<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeesRequest;
use App\Models\Fee;
use App\Models\Grade;
use Illuminate\Http\Request;

class FeesController extends Controller
{
    public function index()
    {
        $fees = Fee::all();
        $Grades = Grade::all();
        return view('pages.Fees.index', compact('fees', 'Grades'));
    }

    public function create()
    {
        $Grades = Grade::all();
        return view('pages.Fees.add', compact('Grades'));
    }

    public function store(StoreFeesRequest $request)
    {
        $fees = new Fee();
        $fees->title = ['en' => $request->title_en, 'ar' => $request->title_ar];
        $fees->amount  = $request->amount;
        $fees->Grade_id  = $request->Grade_id;
        $fees->Classroom_id  = $request->Classroom_id;
        $fees->description  = $request->description;
        $fees->Fee_type  = $request->Fee_type;
        $fees->year  = $request->year;
        $fees->save();
        toastr()->success(trans('messages.success'));
        return redirect()->route('Fees.create');
    }

    public function edit($id)
    {
        $fee = Fee::findorfail($id);
        $Grades = Grade::all();
        return view('pages.Fees.edit', compact('fee', 'Grades'));
    }

    public function update(StoreFeesRequest $request)
    {
        try {
            $fees = Fee::findorfail($request->id);
            $fees->title = ['en' => $request->title_en, 'ar' => $request->title_ar];
            $fees->amount  = $request->amount;
            $fees->Grade_id  = $request->Grade_id;
            $fees->Classroom_id  = $request->Classroom_id;
            $fees->description  = $request->description;
            $fees->year  = $request->year;
            $fees->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('Fees.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        try {
            Fee::destroy($request->id);
            toastr()->success(trans('messages.Delete'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
