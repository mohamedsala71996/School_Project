<?php

namespace App\Repository;

interface TeacherRepositoryInterface
{

    public function getAllTeachers();
    public function getGender();
    public function getSpecialization();
    public function addTeachers($request);
    public function getOneTeacher($id);
    public function updateTeacher($request, $id);
    public function deleteTeacher($request);
}
