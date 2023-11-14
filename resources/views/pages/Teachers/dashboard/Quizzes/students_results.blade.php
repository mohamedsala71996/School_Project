@extends('layouts.master')
@section('css')
    @section('title')
        قائمة الطلاب المختبره
    @stop
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>اسم الطالب</th>
                                            <th>الدرجة</th>
                                            <th>الدرجة الكلية</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($Results as $Result)
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td>{{$Result->student->Name}}</td>
                                                <td>{{$Result->score_sum}}</td>
                                                <td>{{$score}}</td>
                                            </tr>
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