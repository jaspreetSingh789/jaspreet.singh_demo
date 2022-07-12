<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\Test;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function create(Course $course, Test $test)
    {
        return view('questions.create', [
            'course' => $course,
            'unit' => $test->lesson->load('unit')->unit,
            'test' => $test
        ]);
    }

    public function store(Request $request, Course $course, Test $test)
    {
        // dd($request->all());
        // $request->validate([
        //     'name' => 'required',
        //     'answer' => 'required',
        //     'is_answer' => 'required'
        // ]);

        if ($request->input('is_answer') == 'answer1') {
            $is_answer = [1, 0];
        } elseif ($request->input('is_answer') == 'answer2') {
            $is_answer = [0, 1];
        }

        $question = Question::create([
            'name' => $request->name,
        ]);

        $test->questions()->attach($question);

        foreach ($request->input('answer') as $index => $answer) {
            QuestionOption::create([
                'question_id' => $question->id,
                'name' => $answer,
                'is_answer' => $is_answer[$index]
            ]);
        }
        if ($request->input('action') === 'save') {
            return redirect()->route('courses.tests.questions.edit', [$course, $test, $question])->with('success', 'question created successfully');
        }

        return back()->with('success', 'question created successfully');
    }

    public function edit(Course $course, Test $test, Question $question)
    {
        $questionOption = $question->questionOptions()->get();

        return view('questions.edit', [
            'course' => $course,
            'unit' => $test->lesson->load('unit')->unit,
            'test' => $test,
            'question' => $question,
            'questionOption' => $questionOption
        ]);
    }

    public function update(Request $request, Course $course, Test $test, Question $question)
    {
        if ($request->input('is_answer') == 'answer1') {
            $is_answer = [1, 0];
        } elseif ($request->input('is_answer') == 'answer2') {
            $is_answer = [0, 1];
        }

        $question->update([
            'name' => $request->name,
        ]);

        foreach ($request->input('answer') as $index => $answer) {
            $question->questionOptions[$index]->update([
                'question_id' => $question->id,
                'name' => $answer,
                'is_answer' => $is_answer[$index]
            ]);
        }

        return back()->with('success', 'question updated successfully');
    }

    public function destroy(Course $course, Test $test, Question $question)
    {
        $test->questions()->detach($question);

        $question->questionOptions()->delete();
        $question->delete();

        return back()->with('success', 'question deleted successfully');
    }
}
