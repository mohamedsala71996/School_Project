<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Fee;
use App\Models\Fee_Invoice;
use App\Repository\FeeInvoices\FeeInvoicesRepositoryInterface;
use Illuminate\Http\Request;

class FeeInvoiceController extends Controller
{
    protected $FeeInvoicesRepository;

    public function __construct(FeeInvoicesRepositoryInterface $FeeInvoicesRepository)
    {
        $this->FeeInvoicesRepository = $FeeInvoicesRepository;
    }


    public function index()
    {
        return $this->FeeInvoicesRepository->index();
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        return $this->FeeInvoicesRepository->store($request);
    }


    public function show($id)
    {
        return $this->FeeInvoicesRepository->show($id);
    }


    public function edit($id)
    {
        return $this->FeeInvoicesRepository->edit($id);
    }


    public function update(Request $request)
    {
        return $this->FeeInvoicesRepository->update($request);
    }



    public function amount($id)
    {

        return $this->FeeInvoicesRepository->amount($id);
    }
    public function destroy(Request $request)
    {

        return $this->FeeInvoicesRepository->destroy($request);
    }
}
