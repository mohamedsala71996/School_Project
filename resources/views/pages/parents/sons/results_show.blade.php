@extends('layouts.master')
@section('css')
@section('title')
    قائمة نتائج الاختبارات
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    قائمة نتائج الاختبارات
@stop
<!-- breadcrumb -->
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
                                    data-page-length="50" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>اسم الطالب</th>
                                            <th>اسم الاختبار</th>
                                            <th>الدرجة</th>
                                            <th>الدرجة النهائية</th>
                                            <th>تاريخ اجراء الاختبار</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($results as $result)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $result->student->Name }}</td>
                                                <td>{{ $result->quizze->name }}</td>
                                                <td>{{ $result->score_sum }}</td>
                                                @php
                                                    $score = App\Models\Question::where('quizze_id', $result->quizze_id)
                                                        ->get()
                                                        ->sum('score');
                                                @endphp
                                                <td>{{ $score }}</td>
                                                <td>{{ $result->created_at }}</td>
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
