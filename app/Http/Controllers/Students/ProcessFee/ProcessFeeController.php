<?php

namespace App\Http\Controllers\Students\ProcessFee;

use App\Http\Controllers\Controller;
use App\Models\ProcessFee;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProcessFeeController extends Controller
{
    public function index()
    {
        $ProcessingFees = ProcessFee::get();
        return view("pages.ProcessFee.index", compact("ProcessingFees"));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $student = Student::findOrFail($request->student_id);
            $ProcessFee = ProcessFee::create([
                'date' => date('Y-m-d H:i:s'),
                'student_id' => $request->student_id,
                'amount' => $request->Debit,
                'description' => $request->description,
            ]);
            StudentAccount::create([
                'the_date' => date('Y-m-d H:i:s'),
                'type' => "ProcessFee",
                'student_id' => $request->student_id,
                'Grade_id' => $student->Grade_id,
                'Classroom_id' => $student->Classroom_id,
                'process_id' => $ProcessFee->id,
                'Debit' => 0.00,
                'credit' => $request->Debit,
                'description' => $request->description,
            ]);
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('ProcessFee.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        $Debit_sum = StudentAccount::where("student_id", $id)->sum("Debit");
        $credit_sum = StudentAccount::where("student_id", $id)->sum("credit");
        $amount = number_format($Debit_sum - $credit_sum);
        return view("pages.ProcessFee.add", compact("student", "amount"));
    }

    public function edit($id)
    {
        $ProcessingFee = ProcessFee::findOrFail($id);
        return view("pages.ProcessFee.edit", compact("ProcessingFee"));
    }

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $ProcessFee = ProcessFee::where("id", $request->id)->update([
                'amount' => $request->Debit,
                'description' => $request->description,
            ]);
            StudentAccount::where("process_id", $request->id)->update([
                'credit' => $request->Debit,
                'description' => $request->description,
            ]);
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('ProcessFee.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        ProcessFee::where("id", $request->id)->first()->delete();
        toastr()->success(trans('messages.Delete'));
        return redirect()->route('ProcessFee.index');
    }
}
