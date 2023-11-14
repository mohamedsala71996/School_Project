<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Http\Controllers\Controller;
use App\Repository\ExamsTeacher\ExamsTeacherRepositoryInterface;
use Illuminate\Http\Request;

class ExamsTeacherController extends Controller
{

    protected $Exam;

    public function __construct(ExamsTeacherRepositoryInterface $Exam)
    {
        $this->Exam = $Exam;
    }

    public function index()
    {
        return $this->Exam->index();
    }

    public function create()
    {
        return $this->Exam->create();
    }


    public function store(Request $request)
    {
        return $this->Exam->store($request);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return $this->Exam->edit($id);
    }

    public function update(Request $request)
    {
        return $this->Exam->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->Exam->destroy($request);
    }
}
