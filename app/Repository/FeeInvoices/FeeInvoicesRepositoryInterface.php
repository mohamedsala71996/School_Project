<?php

namespace App\Repository\FeeInvoices;

interface FeeInvoicesRepositoryInterface
{

    public function index();
    public function show($id);
    public function store($id);
    public function amount($id);
    public function edit($id);
    public function update($request);
    public function destroy($request);
}
