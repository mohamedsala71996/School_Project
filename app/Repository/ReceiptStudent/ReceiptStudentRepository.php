<?php

namespace App\Repository\ReceiptStudent;

use App\Models\FundAccount;
use App\Models\ReceiptStudent;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class ReceiptStudentRepository implements ReceiptStudentRepositoryInterface
{

    public function index()
    {
        $receipt_students = ReceiptStudent::all();
        return view("pages.Receipt.index", compact("receipt_students"));
    }


    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view("pages.Receipt.add", compact("student"));
    }


    public function store($request)
    {
        try {
            DB::beginTransaction();
            $Debit = $request->Debit;
            $student_id = $request->student_id;
            $description = $request->description;
            $student = Student::findOrFail($student_id);

            $ReceiptStudent = ReceiptStudent::create([
                'date' => date('Y-m-d H:i:s'),
                'student_id' => $student_id,
                'Debit' => $Debit,
                'description' => $description,
            ]);

            FundAccount::create([

                'date' => date('Y-m-d H:i:s'),
                'receipt_id' => $ReceiptStudent->id,
                'Debit' => $Debit,
                'credit' => 0.00,
                'description' => $description,
            ]);

            StudentAccount::create([
                'the_date' => date('Y-m-d H:i:s'),
                'type' => "receipt",
                'student_id' => $student_id,
                'Grade_id' => $student->Grade_id,
                'Classroom_id' => $student->Classroom_id,
                'receipt_id' => $ReceiptStudent->id,
                'Debit' => 0.00,
                'credit' => $Debit,
                'description' => $description,
            ]);
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('ReceiptStudent.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function edit($id)
    {
        $ReceiptStudent = ReceiptStudent::findorFail($id);
        return view("pages.Receipt.edit", compact("ReceiptStudent"));
    }


    public function update($request)
    {
        try {
            DB::beginTransaction();
            $Debit = $request->Debit;
            $student_id = $request->student_id;
            $description = $request->description;
            $receipt_id = $request->id;

            ReceiptStudent::where("id", $receipt_id)->update([
                'Debit' => $Debit,
                'description' => $description,
            ]);

            FundAccount::where("receipt_id", $receipt_id)->update([
                'Debit' => $Debit,
                'description' => $description,
            ]);

            StudentAccount::where("receipt_id", $receipt_id)->update([
                'credit' => $Debit,
                'description' => $description,
            ]);

            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('ReceiptStudent.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy($request)
    {
        ReceiptStudent::where("id", $request->id)->first()->delete();
        toastr()->success(trans('messages.Delete'));
        return redirect()->route('ReceiptStudent.index');
    }
}
