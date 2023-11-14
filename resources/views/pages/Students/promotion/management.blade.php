@extends('layouts.master')
@section('css')
@section('title')
    {{ trans('main_trans.list_students') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('main_trans.list_students') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session()->has('add'))
    <div class="alert alert-success">
        {{ session('add') }}
    </div>
@endif
@if (session()->has('wrong'))
    <div class="alert alert-danger">
        {{ session('wrong') }}
    </div>
@endif
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">

                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Delete_all">
                                تراجع الكل
                            </button>
                            <br><br>


                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th class="alert-info">#</th>
                                            <th class="alert-info">{{ trans('Students_trans.name') }}</th>
                                            <th class="alert-danger">المرحلة الدراسية السابقة</th>
                                            <th class="alert-danger">السنة الدراسية</th>
                                            <th class="alert-danger">الصف الدراسي السابق</th>
                                            <th class="alert-danger">القسم الدراسي السابق</th>
                                            <th class="alert-success">المرحلة الدراسية الحالي</th>
                                            <th class="alert-success">السنة الدراسية الحالية</th>
                                            <th class="alert-success">الصف الدراسي الحالي</th>
                                            <th class="alert-success">القسم الدراسي الحالي</th>
                                            <th>{{ trans('Students_trans.Processes') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($Promotion as $Promotions)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $Promotions->Student->Name }}</td>
                                                <td>{{ $Promotions->Grade_from->Name }}</td>
                                                <td>{{ $Promotions->academic_year }}</td>
                                                <td>{{ $Promotions->Classroom_from->Name }}</td>
                                                <td>{{ $Promotions->Section_from->Name }}</td>
                                                <td>{{ $Promotions->Grade_to->Name }}</td>
                                                <td>{{ $Promotions->academic_year_new }}</td>
                                                <td>{{ $Promotions->Classroom_to->Name }}</td>
                                                <td>{{ $Promotions->Section_to->Name }}</td>
                                                <td>
                                                    <a href="" class="btn btn-info btn-sm" role="button"
                                                        aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#Delete_Student{{ $Promotions->id }}"
                                                        title="{{ trans('Grades_trans.Delete') }}"><i
                                                            class="fa fa-trash"></i></button>
                                                    <a href="" class="btn btn-warning btn-sm" role="button"
                                                        aria-pressed="true"><i class="far fa-eye"></i></a>
                                                </td>
                                            </tr>
                                            @include('pages.Students.promotion.Delete_one')
                                        @endforeach
                                        @include('pages.Students.promotion.Delete_all')

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
