@extends('layouts.master')
@section('css')
@section('title')
    {{ trans('Teacher_trans.Edit_Teacher') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Teacher_trans.Edit_Teacher') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('error') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <br>
                        <form action="{{ route('teacher.update', $teacher->id) }}" method="post">
                            {{ method_field('patch') }}
                            @csrf
                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{ trans('Teacher_trans.Email') }}</label>
                                    <input type="hidden" value="{{ $teacher->id }}" name="id">
                                    <input type="email" name="email" value="{{ $teacher->email }}"
                                        class="form-control">
                                    @error('Email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">{{ trans('Teacher_trans.Password') }}</label>
                                    <input type="password" name="password" value="{{ $teacher->password }}"
                                        class="form-control">
                                    @error('Password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>


                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{ trans('Teacher_trans.Name_ar') }}</label>
                                    <input type="text" name="Name_ar"
                                        value="{{ $teacher->getTranslation('Name', 'ar') }}" class="form-control">
                                    @error('Name_ar')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">{{ trans('Teacher_trans.Name_en') }}</label>
                                    <input type="text" name="Name_en"
                                        value="{{ $teacher->getTranslation('Name', 'en') }}" class="form-control">
                                    @error('Name_en')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="inputCity">{{ trans('Teacher_trans.specialization') }}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="Specialization_id">
                                        @foreach ($Specialization as $specialization)
                                            <option @if ($specialization->id == $teacher->Specialization_id) {{ 'selected' }} @endif
                                                value="{{ $specialization->id }}">{{ $specialization->Name }}</option>
                                        @endforeach
                                    </select>
                                    @error('Specialization_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col">
                                    <label for="inputState">{{ trans('Teacher_trans.Gender') }}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="Gender_id">
                                        @foreach ($genders as $gender)
                                            <option @if ($gender->id == $teacher->Gender_id) {{ 'selected' }} @endif
                                                value="{{ $gender->id }}">{{ $gender->Name }}</option>
                                        @endforeach
                                    </select>
                                    @error('Gender_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{ trans('Teacher_trans.Joining_Date') }}</label>
                                    <div class='input-group date'>
                                        <input class="form-control" type="text" id="datepicker-action"
                                            value="{{ $teacher->Joining_Date }}" name="Joining_Date"
                                            data-date-format="yyyy-mm-dd" required>
                                    </div>
                                    @error('Joining_Date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>

                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">{{ trans('Teacher_trans.Address') }}</label>
                                <textarea class="form-control" name="Address" id="exampleFormControlTextarea1" rows="4">{{ $teacher->Address }}</textarea>
                                @error('Address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                                type="submit">{{ trans('Parent_trans.Next') }}</button>
                        </form>
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
