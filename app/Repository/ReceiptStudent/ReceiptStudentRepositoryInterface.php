<?php

namespace App\Repository\ReceiptStudent;

interface ReceiptStudentRepositoryInterface
{

    public function show($id);
    public function store($request);
    public function index();
    public function edit($id);
    public function update($request);
    public function destroy($request);
}
