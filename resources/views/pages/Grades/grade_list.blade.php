@extends('layouts.master')
@section('css')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection
@section('title')
    {{ trans('main_trans.Grades_list') }}
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> {{ trans('main_trans.Grades_list') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">

        <div class="col-xl-12 mb-30">

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

                    @if (session()->has('relation'))
                        <div class="alert alert-danger">
                            {{ session('relation') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                            {{ trans('Grades_trans.add_Grade') }}
                        </button>
                        <table id="datatable" class="table table-striped table-bordered p-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ trans('Grades_trans.Name') }}</th>
                                    <th>{{ trans('Grades_trans.Notes') }}</th>
                                    <th>{{ trans('Grades_trans.Processes') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($grades as $grade)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $grade->Name }}</td>
                                        <td>{{ $grade->Notes }}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $grade->id }}"
                                                title="{{ trans('Grades_trans.Edit') }}"><i
                                                    class="fa fa-edit"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $grade->id }}"
                                                title="{{ trans('Grades_trans.Delete') }}"><i
                                                    class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <!-- edit_modal_Grade -->
                                    <div class="modal fade" id="edit{{ $grade->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                        {{ trans('Grades_trans.edit_Grade') }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- add_form -->
                                                    <form action="{{ route('grade.update', $grade->id) }}" method="post">
                                                        {{ method_field('patch') }}
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="Name"
                                                                    class="mr-sm-2">{{ trans('Grades_trans.stage_name_ar') }}
                                                                    :</label>
                                                                <input id="Name" type="text" name="name_ar"
                                                                    class="form-control"
                                                                    value="{{ $grade->getTranslation('Name', 'ar') }}"
                                                                    required>
                                                                <input id="id" type="hidden" name="id"
                                                                    class="form-control" value="{{ $grade->id }}}">
                                                            </div>
                                                            <div class="col">
                                                                <label for="Name_en"
                                                                    class="mr-sm-2">{{ trans('Grades_trans.stage_name_en') }}
                                                                    :</label>
                                                                <input type="text" class="form-control"
                                                                    value="{{ $grade->getTranslation('Name', 'en') }}"
                                                                    name="name_en" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label
                                                                for="exampleFormControlTextarea1">{{ trans('Grades_trans.Notes') }}
                                                                :</label>
                                                            <textarea class="form-control" name="notes" id="exampleFormControlTextarea1" rows="3">{{ $grade->Notes }}</textarea>
                                                        </div>
                                                        <br><br>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- delete_modal_Grade -->
                                    <div class="modal fade" id="delete{{ $grade->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                        {{ trans('Grades_trans.delete_Grade') }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('grade.destroy', $grade->id) }}"
                                                        method="post">
                                                        {{ method_field('Delete') }}
                                                        @csrf
                                                        {{ trans('Grades_trans.Warning_Grade') }}
                                                        <input id="id" type="hidden" name="id"
                                                            class="form-control" value="{{ $grade->id }}">
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-danger">{{ trans('Grades_trans.Delete') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>


                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->

    <!--add Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form to send the ID -->
                    <form method="POST" action="{{ route('grade.store') }}">
                        @csrf
                        <!-- Your form fields here -->
                        <div class="form-group">
                            <label for="inputField">{{ trans('Grades_trans.stage_name_ar') }}</label>
                            <input type="text" class="form-control" id="inputField" name="name_ar">
                        </div>
                        <div class="form-group">
                            <label for="inputField">{{ trans('Grades_trans.stage_name_en') }}</label>
                            <input type="text" class="form-control" id="inputField" name="name_en">
                        </div>
                        <div class="form-group">
                            <label for="inputField">{{ trans('Grades_trans.Notes') }}</label>
                            <input type="text" class="form-control" id="inputField" name="notes">
                        </div>
                        <!-- End of form fields -->
                        <button type="submit" class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endsection
