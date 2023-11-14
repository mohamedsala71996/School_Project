<?php

namespace App\Repository\students;

interface StudentRepositoryInterface
{
    public function get_student();
    public function create_student();
    public function Get_Sections($id);
    public function insert_students($request);
    public function update_students($request);
    public function delete_students($request);
    public function delete_files($request);
    public function edit($id);
    public function show_attachments($id);
    public function upload_files($request);
    public function downloadFile($student_name, $file_name);
}
