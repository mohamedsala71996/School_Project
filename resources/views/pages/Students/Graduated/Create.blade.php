@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('main_trans.add_Graduate') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('main_trans.add_Graduate') }}
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

                @if (Session::has('error_Graduated'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('error_Graduated') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form action="{{ route('graduated.store') }}" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="inputState">{{ trans('Students_trans.Grade') }}</label>
                            <select class="custom-select mr-sm-2" name="Grade_id" required>
                                <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                @foreach ($Grades as $Grade)
                                    <option value="{{ $Grade->id }}">{{ $Grade->Name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="Classroom_id">{{ trans('Students_trans.classrooms') }} : <span
                                    class="text-danger">*</span></label>
                            <select class="custom-select mr-sm-2" name="Classroom_id" required>

                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="section_id">{{ trans('Students_trans.section') }} : </label>
                            <select class="custom-select mr-sm-2" name="section_id" required>

                            </select>
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary">تاكيد</button>
                </form>

            </div>
        </div>
    </div>

</div>
<!-- row closed -->
@endsection
@section('js')

<script>
    $(document).ready(function() {
        $('select[name="Grade_id"]').on('change', function() {
            var Grade_id = $(this).val();
            if (Grade_id) {
                $.ajax({
                    url: "{{ URL::to('classes') }}/" + Grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var selectElement = $('select[name="Classroom_id"]');
                        selectElement.empty();
                        var chooseOption =
                            '<option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>';
                        selectElement.append(chooseOption);
                        $.each(data, function(key, value) {
                            selectElement.append('<option value="' + key + '">' +
                                value + '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>



<script>
    $(document).ready(function() {
        $('select[name="Classroom_id"]').on('change', function() {
            var Classroom_id = $(this).val();
            if (Classroom_id) {
                $.ajax({
                    url: "{{ URL::to('Get_Sections') }}/" + Classroom_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="section_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="section_id"]').append(
                                '<option value="' + key + '">' + value +
                                '</option>');
                        });

                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>

@endsection
