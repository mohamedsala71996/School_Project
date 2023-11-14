<?php

namespace App\Http\Controllers\Students\Attendance;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Attendance\AttendanceRepositoryInterface;

class AttendanceController extends Controller
{
   
  protected  AttendanceRepositoryInterface $Attendance;

  public function __construct(AttendanceRepositoryInterface $Attendance){

    $this->Attendance=$Attendance;

  }
  
    public function index()
    {
        return $this->Attendance->index();
    }

  
    
    public function create()
    {
        
    }

    
    
    public function store(Request $request)
    {
        return $this->Attendance->store($request);

    }

   
    
    public function show($id)
    {
        return $this->Attendance->show($id);
    }

    
    public function edit(Attendance $attendance)
    {
        //
    }

    
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

   
    
    public function destroy(Attendance $attendance)
    {
        //
    }
}
