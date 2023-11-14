<?php

namespace App\Repository\promotions;

interface promotionsRepositoryInterface
{
    public function index();
    public function store($request);
    public function create();
    public function destroy($request);
    public function destroy_one($request);
}
