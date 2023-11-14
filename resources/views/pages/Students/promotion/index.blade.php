@extends('layouts.master')
@section('css')
@section('title')
    {{ trans('main_trans.Students_Promotions') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('main_trans.Students_Promotions') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">

    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

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

                <h6 style="color: red;font-family: Cairo">{{ trans('Students_trans.old') }}</h6><br>

                <form method="post" action="{{ route('promotion.store') }}">
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
                        <div class="form-group col">
                            <label for="academic_year">{{ trans('Students_trans.academic_year') }} : <span
                                    class="text-danger">*</span></label>
                            <select class="custom-select mr-sm-2" name="academic_year">
                                <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                <option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
                                <option value="<?php echo date('Y', strtotime('+1 year')); ?>"><?php echo date('Y', strtotime('+1 year')); ?></option>

                            </select>
                        </div>

                    </div>



                    <br>
                    <h6 style="color: red;font-family: Cairo">{{ trans('Students_trans.new') }}</h6><br>

                    <div class="form-row">
                        <div class="form-group col">
                            <label for="inputState">{{ trans('Students_trans.Grade') }}</label>
                            <select class="custom-select mr-sm-2" name="Grade_id_new" required>
                                <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>

                                @foreach ($Grades as $Grade)
                                    <option value="{{ $Grade->id }}">{{ $Grade->Name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="Classroom_id">{{ trans('Students_trans.classrooms') }}: <span
                                    class="text-danger">*</span></label>
                            <select class="custom-select mr-sm-2" name="Classroom_id_new" required>

                            </select>
                        </div>
                        <div class="form-group col">
                            <label for="section_id">:{{ trans('Students_trans.section') }} </label>
                            <select class="custom-select mr-sm-2" name="section_id_new" required>

                            </select>
                        </div>

                        <div class="form-group col">
                            <label for="academic_year">{{ trans('Students_trans.academic_year') }} : <span
                                    class="text-danger">*</span></label>
                            <select class="custom-select mr-sm-2" name="academic_year_new" required>
                                <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                <option value="<?php echo date('Y'); ?>"><?php echo date('Y'); ?></option>
                                <option value="<?php echo date('Y', strtotime('+1 year')); ?>"><?php echo date('Y', strtotime('+1 year')); ?></option>

                            </select>
                        </div>
                    </div>



                    <button type="submit" class="btn btn-primary">{{ trans('Sections_trans.submit') }}</button>
                </form>

            </div>
        </div>
    </div>

</div>
<!-- row closed -->
@endsection
@section('js')

{{-- ---------------------------------old grade------------------ --}}

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

{{-- ---------------------------------new grade------------------ --}}
<script>
    $(document).ready(function() {
        $('select[name="Grade_id_new"]').on('change', function() {
            var Grade_id_new = $(this).val();
            if (Grade_id_new) {
                $.ajax({
                    url: "{{ URL::to('classes') }}/" + Grade_id_new,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var selectElement = $('select[name="Classroom_id_new"]');
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
        $('select[name="Classroom_id_new"]').on('change', function() {
            var Classroom_id_new = $(this).val();
            if (Classroom_id_new) {
                $.ajax({
                    url: "{{ URL::to('Get_Sections') }}/" + Classroom_id_new,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="section_id_new"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="section_id_new"]').append(
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
