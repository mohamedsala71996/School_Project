<?php

namespace App\Repository\Payment;

use App\Models\FundAccount;
use App\Models\Payment;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class PaymentRepository implements PaymentRepositoryInterface
{
    public function index()
    {
        $payment_students = Payment::get();
        return view("pages.Payment.index", compact("payment_students"));
    }


    public function show($id)
    {
        $student = Student::findOrFail($id);
        $Debit_sum = StudentAccount::where("student_id", $id)->sum("Debit");
        $credit_sum = StudentAccount::where("student_id", $id)->sum("credit");
        $amount = number_format($Debit_sum - $credit_sum);
        return view("pages.Payment.add", compact("student", "amount"));
    }


    public function store($request)
    {
        try {

            DB::beginTransaction();
            $student = Student::findOrFail($request->student_id);
            $Payment = Payment::create([
                'date' => date('Y-m-d H:i:s'),
                'student_id' => $request->student_id,
                'amount' => $request->Debit,
                'description' => $request->description,
            ]);
            StudentAccount::create([
                'the_date' => date('Y-m-d H:i:s'),
                'type' => "payment",
                'student_id' => $request->student_id,
                'Grade_id' => $student->Grade_id,
                'Classroom_id' => $student->Classroom_id,
                'payment_id' => $Payment->id,
                'Debit' => $request->Debit,
                'credit' => 0.00,
                'description' => $request->description,
            ]);
            FundAccount::create([

                'date' => date('Y-m-d H:i:s'),
                'payment_id' => $Payment->id,
                'Debit' => 0.00,
                'credit' => $request->Debit,
                'description' => $request->description,
            ]);
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Payment.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    
    public function edit($id)
    {
        $payment_student = Payment::findorfail($id);
        return view('pages.Payment.edit', compact('payment_student'));
    }


    public function update($request)
    {
        try {

            DB::beginTransaction();
            $Payment = Payment::where("id", $request->id)->update([
                'amount' => $request->Debit,
                'description' => $request->description,
            ]);
            StudentAccount::where("payment_id", $request->id)->update([
                'Debit' => $request->Debit,
                'description' => $request->description,
            ]);
            FundAccount::where("payment_id", $request->id)->update([
                'credit' => $request->Debit,
                'description' => $request->description,
            ]);
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Payment.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function destroy($request)
    {
        Payment::destroy($request->id);
        toastr()->success(trans('messages.Delete'));
        return redirect()->back();
    }
}
