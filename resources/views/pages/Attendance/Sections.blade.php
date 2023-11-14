@extends('layouts.master')
@section('css')
@section('title')
    {{ trans('Sections_trans.title_page') }}: الحضور والغياب
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Sections_trans.title_page') }}: الحضور والغياب
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card card-statistics h-100">
                @foreach ($grades as $grade)
                    <div class="card-body">
                        <div class="accordion gray plus-icon round">
                            <div class="acd-group">
                                <a href="#" class="acd-heading">{{ $grade->Name }}</a>
                                <div class="acd-des">

                                    <div class="row">
                                        <div class="col-xl-12 mb-30">
                                            <div class="card card-statistics h-100">
                                                <div class="card-body">
                                                    <div class="d-block d-md-flex justify-content-between">
                                                        <div class="d-block">
                                                        </div>
                                                    </div>
                                                    <div class="table-responsive mt-15">
                                                        <table class="table center-aligned-table mb-0">
                                                            <thead>
                                                                <tr class="text-dark">
                                                                    <th>#</th>
                                                                    <th>{{ trans('Sections_trans.Name_Section') }}
                                                                    </th>
                                                                    <th>{{ trans('Sections_trans.Name_Class') }}</th>
                                                                    <th>{{ trans('Sections_trans.Status') }}</th>
                                                                    <th>{{ trans('Sections_trans.Processes') }}</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $i = 0;
                                                                ?>
                                                                @foreach ($grade->section as $section)
                                                                    <tr>
                                                                        <?php $i++; ?>
                                                                        <td>{{ $i }}</td>
                                                                        <td>{{ $section->Name }}</td>
                                                                        <td>{{ $section->class_room->Name }}</td>
                                                                        <td>
                                                                            <label
                                                                                class="badge badge-{{ $section->status == 0 ? 'danger' : 'success' }}">{{ $section->status == 0 ? 'غير نشط' : ' نشط' }}</label>
                                                                        </td>
                                                                        <td>
                                                                            <a href="{{ route('Attendance.show', $section->id) }}"
                                                                                class="btn btn-warning btn-sm"
                                                                                role="button" aria-pressed="true">قائمة
                                                                                الطلاب</a>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
@endsection
