<?php

namespace App\Http\Controllers\Students\ProcessFee;

use App\Http\Controllers\Controller;
use App\Models\ProcessFee;
use App\Repository\ProcessFee\ProcessFeeRepositoryInterface;
use Illuminate\Http\Request;

class ProcessFeeController extends Controller
{
    private ProcessFeeRepositoryInterface $process;

    public function __construct(ProcessFeeRepositoryInterface $process)
    {
        $this->process = $process;
    }


    public function index()
    {
        return  $this->process->index();
    }


    public function create()
    {
    }

    public function store(Request $request)
    {
        return  $this->process->store($request);
    }


    public function show($id)
    {
        return  $this->process->show($id);
    }


    public function edit($id)
    {
        return  $this->process->edit($id);
    }


    public function update(Request $request)
    {
        return  $this->process->update($request);
    }


    public function destroy(Request $request)
    {
        return  $this->process->destroy($request);
    }
}
