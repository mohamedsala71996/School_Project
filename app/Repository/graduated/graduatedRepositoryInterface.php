<?php

namespace App\Repository\graduated;

interface graduatedRepositoryInterface
{

public function create();
public function index();
public function softdelete($request);
public function update($request);
public function destroy($request);

    
}