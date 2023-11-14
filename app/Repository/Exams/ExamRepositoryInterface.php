<?php

namespace App\Repository\Exams;

interface ExamRepositoryInterface
{
    public function index();

    public function create();

    public function store($request);

    public function edit($id);

    public function update($request);

    public function destroy($request);
}