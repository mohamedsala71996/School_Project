@extends('layouts.master')

@section('css')
    <!-- Add any additional CSS styles if needed -->
@endsection

@section('title')
    إجراء اختبار
@endsection

@section('content')

    <div class="row">

        <div class="col-md-12 mb-4">
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
                    <div>
                        @if (isset($score_result))
                            <h2>تم اجتياز الاختبار والنتيجة هي: {{ $score_result }} </h2>
                            <h2>من: {{ $score }}</h2>
                        @else
                            <h2 class="text-center mb-4">إجراء اختبار</h2>
                            <form action="{{ route('studentQuiz.store') }}" method="post">
                                @csrf
                                <div class="card card-statistics mb-4">
                                    <div class="card-body">
                                        @foreach ($Questions as $Question)
                                            <h5 class="card-title"><span>{{ $loop->iteration }}:
                                                </span>{{ $Question->title }}</h5>
                                            <div class="custom-control custom-radio">
                                                <input type="hidden" name="quiz_id" value="{{ $Question->quizze_id }}">
                                                <input type="hidden" name="score" value="{{ $Question->score }}">
                                                <input type="hidden" name="right_answer[]"
                                                    value="{{ $Question->right_answer }}">
                                                @foreach (preg_split('/([-\:])/', $Question->answers) as $index => $answer)
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input"
                                                            id="answers{{ $index }}"
                                                            name='answers[{{ $loop->parent->index }}]'
                                                            value="{{ $answer }}" required>
                                                        <label class="form-check-label"
                                                            for="answers{{ $index }}">{{ $answer }}</label>
                                                    </div>
                                                    <br>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">حفظ البيانات</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

@endsection

@section('js')
@endsection
