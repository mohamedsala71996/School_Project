<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Http\Requests\storeTeacherRequest;
use App\Models\Teacher;
use App\Repository\TeacherRepositoryInterface;
use Illuminate\Http\Request;

class TeacherController extends Controller
{

    private TeacherRepositoryInterface $TeacherRepository;

    public function __construct(TeacherRepositoryInterface $TeacherRepository)
    {
        $this->TeacherRepository = $TeacherRepository;
    }

    public function index()
    {
        $AllTeachers = $this->TeacherRepository->getAllTeachers();
        return view("pages.Teachers.Teachers", compact("AllTeachers"));
    }


    public function create()
    {
        $genders = $this->TeacherRepository->getGender();
        $Specialization = $this->TeacherRepository->getSpecialization();

        return view("pages.Teachers.create", compact("genders", "Specialization"));
    }

    public function store(storeTeacherRequest $request)
    {
        return $this->TeacherRepository->addTeachers($request);
    }


    public function show(Teacher $teacher)
    {
        //
    }


    public function edit($id)
    {

        $teacher = $this->TeacherRepository->getOneTeacher($id);
        $genders = $this->TeacherRepository->getGender();
        $Specialization = $this->TeacherRepository->getSpecialization();

        return view("pages.Teachers.Edit", compact("genders", "Specialization", "teacher"));
    }


    public function update(storeTeacherRequest $request, $id)
    {
        return $this->TeacherRepository->updateTeacher($request, $id);
    }


    public function destroy(Request $request)
    {
        return $this->TeacherRepository->deleteTeacher($request);
    }
}
