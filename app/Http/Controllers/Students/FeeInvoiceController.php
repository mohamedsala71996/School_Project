<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Fee;
use App\Models\Fee_Invoice;
use App\Models\Student;
use App\Models\StudentAccount;
use App\Repository\FeeInvoices\FeeInvoicesRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FeeInvoiceController extends Controller
{
    public function index()
    {
        $Fee_invoices = Fee_invoice::get();
        return view("pages.Fees_Invoices.index", compact("Fee_invoices"));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            foreach ($request->List_Fees as $List_Fees) {

                $Fees = Fee_invoice::create([
                    'invoice_date' => date('Y-m-d H:i:s'),
                    'student_id' => $List_Fees['student_id'],
                    'Grade_id' => $request->Grade_id,
                    'Classroom_id' => $request->Classroom_id,
                    'fee_id' => $List_Fees['fee_id'],
                    'amount' => $List_Fees['amount'],
                    'description' => $List_Fees['description'],
                ]);

                StudentAccount::create([
                    'the_date' => date('Y-m-d H:i:s'),
                    'type' => "invoice",
                    'student_id' => $List_Fees['student_id'],
                    'fee_invoice_id' => $Fees->id,
                    'Grade_id' => $request->Grade_id,
                    'Classroom_id' => $request->Classroom_id,
                    'Debit' => $List_Fees['amount'],
                    'Credit' => 0.00,
                    'description' => $List_Fees['description'],
                ]);
            }
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('FeeInvoice.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        $student = Student::where("id", $id)->first();
        $fees = Fee::where("Classroom_id", $student->Classroom_id)->get();
        return view("pages.Fees_Invoices.add", compact("student", "fees"));
    }

    public function edit($id)
    {
        $Fee_invoice = Fee_invoice::where("id", $id)->first();
        $Fees = Fee::where("Classroom_id", $Fee_invoice->Classroom_id)->get();
        return view("pages.Fees_Invoices.edit", compact("Fee_invoice", "Fees"));
    }

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            Fee_invoice::where("id", $request->id)->update([
                'fee_id' => $request->fee_id,
                'amount' => $request->amount,
                'description' => $request->description,
            ]);

            StudentAccount::where('fee_invoice_id', $request->id)->update([
                'Debit' => $request->amount,
                'Credit' => 0.00,
                'description' => $request->description,
            ]);

            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('FeeInvoice.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function amount($id)
    {
        $Fees = Fee::where("id", $id)->pluck('amount');
        return $Fees;
    }
    public function destroy(Request $request)
    {
        Fee_invoice::where("id", $request->id)->first()->delete();
        toastr()->success(trans('messages.Delete'));
        return redirect()->route('FeeInvoice.index');
    }
}
