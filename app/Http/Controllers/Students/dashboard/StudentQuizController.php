<?php

namespace App\Http\Controllers\Students\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Result;

class StudentQuizController extends Controller
{


    public function index()
    {
        $Quizes = Quiz::where("grade_id", auth()->user()->Grade_id)
            ->where("classroom_id", auth()->user()->Classroom_id)
            ->where("section_id", auth()->user()->section_id)
            ->orderBy('id', 'desc')
            ->get();
        return view("pages.Students.dashboard.quiz.index", compact("Quizes"));
    }



    public function create()
    {
        //
    }



    public function store(Request $request)
    {
        $request->validate([
            'answers.*' => 'required', // Each answer in the array is required
        ]);
        $score_result = 0;
        $x = 0;
        foreach ($request->answers as $answer) {
            if ($answer == $request->right_answer[$x++]) {
                $score_result += $request->score;
            } else {
                $score_result += 0;
            }
        }
        Result::create([
            "score_sum" => $score_result,
            "quizze_id" => $request->quiz_id,
            "student_id" => auth()->user()->id,
        ]);
        $score = Question::where("quizze_id", $request->quiz_id)->get()->sum("score");
        return view("pages.Students.dashboard.quiz.show-question", compact("score_result", "score"));
    }


    public function show($quiz_id)
    {
        if (isset(Result::where('quizze_id', $quiz_id)->where('student_id', auth()->user()->id)->first()->score_sum)) {
            $score_result = Result::where('quizze_id', $quiz_id)->where('student_id', auth()->user()->id)->first()->score_sum;
            $score = Question::where("quizze_id", $quiz_id)->get()->sum("score");
            return view("pages.Students.dashboard.quiz.show-question", compact("score_result", "score"));
        } else {
            $student_id = auth()->user()->id;
            $Questions = Question::where("quizze_id", $quiz_id)->get();
            return view("pages.Students.dashboard.quiz.show-question", compact("Questions", "student_id"));
        }
    }



    public function edit(string $id)
    {
        //
    }



    public function update(Request $request, string $id)
    {
        //
    }



    public function destroy(string $id)
    {
        //
    }
}
