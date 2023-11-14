@extends('layouts.master')
@section('css')
@section('title')
    {{ trans('main_trans.List_Teachers') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('main_trans.List_Teachers') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')

@if (session()->has('add'))
    <div class="alert alert-success">
        {{ session('add') }}
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
                            <a href="{{ route('teacher.create') }}" class="btn btn-success btn-sm" role="button"
                                aria-pressed="true">{{ trans('Teacher_trans.Add_Teacher') }}</a><br><br>
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ trans('Teacher_trans.Name_Teacher') }}</th>
                                            <th>{{ trans('Teacher_trans.Gender') }}</th>
                                            <th>{{ trans('Teacher_trans.Joining_Date') }}</th>
                                            <th>{{ trans('Teacher_trans.specialization') }}</th>
                                            <th>{{ trans('Grades_trans.Processes') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @foreach ($AllTeachers as $AllTeacher)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $AllTeacher->Name }}</td>
                                                <td>{{ $AllTeacher->Gender->Name }}</td>
                                                <td>{{ $AllTeacher->Joining_Date }}</td>
                                                <td>{{ $AllTeacher->Specialization->Name }}</td>
                                                <td>
                                                    <a href="{{ route('teacher.edit', $AllTeacher->id) }}"
                                                        class="btn btn-info btn-sm" role="button"
                                                        aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-toggle="modal"
                                                        data-target="#delete_Teacher{{ $AllTeacher->id }}"
                                                        title="{{ trans('Grades_trans.Delete') }}"><i
                                                            class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="delete_Teacher{{ $AllTeacher->id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <form action="{{ route('teacher.destroy', 'test') }}"
                                                        method="post">
                                                        {{ method_field('delete') }}
                                                        {{ csrf_field() }}
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 style="font-family: 'Cairo', sans-serif;"
                                                                    class="modal-title" id="exampleModalLabel">
                                                                    {{ trans('Teacher_trans.Delete_Teacher') }}</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p> {{ trans('My_Classes_trans.Warning_Grade') }}</p>
                                                                <input type="hidden" name="id"
                                                                    value="{{ $AllTeacher->id }}">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{ trans('My_Classes_trans.Close') }}</button>
                                                                    <button type="submit"
                                                                        class="btn btn-danger">{{ trans('My_Classes_trans.submit') }}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
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
