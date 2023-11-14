<?php

namespace App\Http\Controllers\Students\Promotion;

use App\Repository\promotions\promotionsRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    private promotionsRepositoryInterface $promotionsRepository;

    public function __construct(promotionsRepositoryInterface $promotionsRepository)
    {
        $this->promotionsRepository = $promotionsRepository;
    }


    public function index()
    {
        return  $this->promotionsRepository->index();
    }



    public function create()
    {

        return  $this->promotionsRepository->create();
    }



    public function store(Request $request)
    {

        return  $this->promotionsRepository->store($request);
    }



    public function show($id)
    {
    }



    public function edit($id)
    {
    }


    public function update(Request $request, string $id)
    {
    }




    public function destroy(Request $request, $id)
    {

        return  $this->promotionsRepository->destroy($request);
    }

    public function destroy_one(Request $request)
    {

        return  $this->promotionsRepository->destroy_one($request);
    }
}
