<?php

namespace App\Http\Controllers\Students;

use App\Repository\students\StudentRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\storeStudentRequest;

class StudentController extends Controller
{
    private StudentRepositoryInterface $StudentRepository;

    public function __construct(StudentRepositoryInterface $StudentRepository)
    {
        $this->StudentRepository = $StudentRepository;
    }


    public function index()
    {
        return $this->StudentRepository->get_student();
    }



    public function create()
    {
        return $this->StudentRepository->create_student();
    }



    public function store(storeStudentRequest $request)
    {

        return $this->StudentRepository->insert_students($request);
    }



    public function show($id)
    {

        return $this->StudentRepository->show_attachments($id);
    }



    public function edit($id)
    {
        return $this->StudentRepository->edit($id);
    }


    public function update(storeStudentRequest $request, string $id)
    {
        return $this->StudentRepository->update_students($request);
    }




    public function destroy(Request $request, $id)
    {

        return $this->StudentRepository->delete_students($request);
    }
    public function Get_Sections($id)
    {
        return $this->StudentRepository->Get_Sections($id);
    }
    public function upload_files(Request $request)
    {
        return $this->StudentRepository->upload_files($request);
    }


    public function delete_files(Request $request)
    {

        return $this->StudentRepository->delete_files($request);
    }


    public function downloadFile($student_name, $file_name)
    {

        return $this->StudentRepository->downloadFile($student_name, $file_name);
    }
}
