<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Result as ModelsResult;
use Illuminate\Http\Request;
use App\Models\Result;

class QuestionController extends Controller
{

  public function index()
  {
    //
  }


  public function create()
  {
    //
  }

  public function store(Request $request)
  {
    if ($request) {
      Question::create([
        "title" => $request->title,
        "answers" => $request->answers,
        "right_answer" => $request->right_answer,
        "score" => $request->score,
        "quizze_id" => $request->quizz_id,
      ]);
      toastr()->success(trans('messages.success'));
      return redirect()->route('question.show', $request->quizz_id);
    }
  }

  public function show($id)
  {
    $questions = Question::where("quizze_id", $id)->get();
    $quiz = Quiz::findOrfail($id);
    return view("pages.Teachers.dashboard.questions.index", compact("questions", "quiz"));
  }

  public function add_questions($id)
  {
    $quiz = Quiz::findOrfail($id);
    return view("pages.Teachers.dashboard.questions.add", compact("quiz"));
  }

  public function edit($id)
  {
    $question = Question::findOrFail($id);
    return view("pages.Teachers.dashboard.questions.edit", compact("question"));
  }

  public function update(Request $request, $id)
  {
    if ($request) {
      $Question = Question::findOrFail($id);
      $Question->update([
        "title" => $request->title,
        "answers" => $request->answers,
        "right_answer" => $request->right_answer,
        "score" => $request->score,
      ]);
      toastr()->success(trans('messages.success'));
      return redirect()->route('question.show', $Question->quizze_id);
    }
  }

  public function destroy($id)
  {
    $Question = Question::findOrFail($id);
    Question::destroy($id);
    toastr()->success(trans('messages.Delete'));
    return redirect()->route('question.show', $Question->quizze_id);
  }

  public function show_results($quiz_id)
  {
    $Results = Result::where("quizze_id", $quiz_id)->get();
    $score = Question::where("quizze_id", $quiz_id)->get()->sum("score");
    return view("pages.Teachers.dashboard.Quizzes.students_results", compact("Results", "score"));
  }
}
