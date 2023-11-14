<?php

namespace App\Http\Controllers\Students\Graduated;

use App\Http\Controllers\Controller;
use App\Repository\graduated\graduatedRepositoryInterface;
use Illuminate\Http\Request;

class GraduatedController extends Controller
{
    private graduatedRepositoryInterface $graduatedRepository;

    public function __construct(graduatedRepositoryInterface $graduatedRepository)
    {
        $this->graduatedRepository = $graduatedRepository;
    }


    public function index()
    {

        return $this->graduatedRepository->index();
    }



    public function create()
    {



        return $this->graduatedRepository->create();
    }



    public function store(Request $request)
    {

        return $this->graduatedRepository->softdelete($request);
    }



    public function show($id)
    {
    }



    public function edit($id)
    {
    }


    public function update(Request $request,  $id)
    {
        return $this->graduatedRepository->update($request);
    }




    public function destroy(Request $request, $id)
    {

        return $this->graduatedRepository->destroy($request);
    }

    public function destroy_one(Request $request)
    {
    }
}
