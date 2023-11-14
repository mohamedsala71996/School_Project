@extends('layouts.master')
@section('css')
@section('title')
    تعديل رسوم دراسية
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    تعديل رسوم دراسية
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

                <form action="{{ route('FeeInvoice.update', 'test') }}" method="post" autocomplete="off">
                    @method('PATCH')
                    @csrf
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="inputEmail4">اسم الطالب</label>
                            <input type="text" value="{{ $Fee_invoice->student->Name }}" readonly name="title_ar"
                                class="form-control">
                            <input type="hidden" value="{{ $Fee_invoice->id }}" name="id" class="form-control">
                        </div>


                        <div class="form-group col">
                            <label for="inputEmail4">المبلغ</label>
                            <input type="number" value="{{ $Fee_invoice->amount }}" name="amount"
                                class="form-control">
                        </div>

                    </div>


                    <div class="form-row">

                        <div class="form-group col">
                            <label for="inputZip">نوع الرسوم</label>
                            <select class="custom-select mr-sm-2" name="fee_id">
                                @foreach ($Fees as $Fee)
                                    <option {{ $Fee->id == $Fee_invoice->fee_id ? 'selected' : '' }}
                                        value="{{ $Fee->id }}">{{ $Fee->title }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="inputAddress">ملاحظات</label>
                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="4">{{ $Fee_invoice->description }}</textarea>
                    </div>
                    <br>

                    <button type="submit" class="btn btn-primary">تاكيد</button>

                </form>

            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection
