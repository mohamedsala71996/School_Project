@extends('layouts.master')
@section('css')
@section('title')
    قائمة الحضور والغياب للطلاب
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    قائمة الحضور والغياب للطلاب
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- @if (session('status'))
        <div class="alert alert-danger">
            <ul>
                <li>{{ session('status') }}</li>
            </ul>
        </div>
    @endif --}}



<h5 style="font-family: 'Cairo', sans-serif;color: red"> تاريخ اليوم : {{ date('Y-m-d') }}</h5>
<form method="post" action="{{ route('storeAttendance') }}" autocomplete="off">
    @csrf
    <table class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
        <thead>
            <tr>
                <th class="alert-success">#</th>
                <th class="alert-success">{{ trans('Students_trans.name') }}</th>
                <th class="alert-success">{{ trans('Students_trans.email') }}</th>
                <th class="alert-success">{{ trans('Students_trans.gender') }}</th>
                <th class="alert-success">{{ trans('Students_trans.Grade') }}</th>
                <th class="alert-success">{{ trans('Students_trans.classrooms') }}</th>
                <th class="alert-success">{{ trans('Students_trans.section') }}</th>
                <th class="alert-success">{{ trans('Students_trans.Processes') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($student as $student)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $student->Name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->gender->Name }}</td>
                    <td>{{ $student->grade->Name }}</td>
                    <td>{{ $student->classroom->Name }}</td>
                    <td>{{ $student->section->Name }}</td>

                    {{-- @if (isset(
        $student->Attendance()->where('attendence_date', date('Y-m-d'))->first()->student_id,
    ))
                  <td> 
                    <div class="row">
                        <div class="col">
                            <input type="radio" id="attendance{{$student->id}}" name="status[{{$student->id}}]" value="1"
                            {{($student->Attendance()->where("attendence_date",date('Y-m-d'))->first()->attendence_status==true)?"checked":""}}
                            disabled>
                            <label for="attendance{{$student->id}}">حضور</label>
                        </div>
                        <div class="col">
                            <input type="radio" id="absence{{$student->id}}" name="status[{{$student->id}}]" value="0" 
                            {{($student->Attendance()->where("attendence_date",date('Y-m-d'))->first()->attendence_status==false)?"checked":""}}
                            disabled>
                            <label for="absence{{$student->id}}">غياب</label>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit_attendance{{$student->id}}" title="تعديل"><i class="fa fa-edit"></i></button>
                        </div>
                    </div>
                </td>
                @include('pages.Teachers.dashboard.attendance.edit')

                  @else --}}
                    <td>

                        <div class="row">
                            <div class="col">
                                <input type="radio" id="attendance{{ $student->id }}"
                                    name="status[{{ $student->id }}]" value="1"
                                    @if (isset(
                                            $student->Attendance()->where('attendence_date', date('Y-m-d'))->first()->attendence_status)) {{ $student->Attendance()->where('attendence_date', date('Y-m-d'))->first()->attendence_status == true? 'checked': '' }} @endif>
                                <label for="attendance{{ $student->id }}">حضور</label>
                            </div>
                            <div class="col">
                                <input type="radio" id="absence{{ $student->id }}"
                                    name="status[{{ $student->id }}]" value="0"
                                    @if (isset(
                                            $student->Attendance()->where('attendence_date', date('Y-m-d'))->first()->attendence_status)) {{ $student->Attendance()->where('attendence_date', date('Y-m-d'))->first()->attendence_status == false? 'checked': '' }} @endif>
                                <label for="absence{{ $student->id }}">غياب</label>
                            </div>
                        </div>
                    </td>
                    {{-- @endif --}}

                </tr>
                <input type="hidden" name="student_id[]" value="{{ $student->id }}">
                <input type="hidden" name="grade_id" value="{{ $student->Grade_id }}">
                <input type="hidden" name="classroom_id" value="{{ $student->Classroom_id }}">
                <input type="hidden" name="section_id" value="{{ $student->section_id }}">
            @endforeach

        </tbody>
    </table>
    <P>

        <button class="btn btn-success" type="submit">{{ trans('Students_trans.submit') }}</button>
    </P>
</form>
<br>
<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection
