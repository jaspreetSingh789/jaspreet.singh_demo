<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Models\Course;
use App\Models\Question;
use App\Models\QuestionOption;
use App\Models\Test;
use Illuminate\Database\Eloquent\Collection;

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

    public function store(QuestionRequest $request, Course $course, Test $test)
    {
        $request->validated();

        if ($request->input('is_answer') == 'answer1') {
            $is_answer = [1, 0];
        } elseif ($request->input('is_answer') == 'answer2') {
            $is_answer = [0, 1];
        }

        $question = Question::create([
            'name' => $request->name,
        ]);

        $test->questions()->attach($question);

        $collection = new Collection($request->answer);

        $collection->each(function ($answer, $key) use ($question, $is_answer) {
            $questionOption = QuestionOption::make([
                'question_id' => $question->id,
                'name' => $answer,
                'is_answer' => $is_answer[$key]
            ]);
            $questionOption->save();
        });

        if ($request->input('action') === 'save') {
            return redirect()->route('courses.tests.questions.edit', [$course, $test, $question])
                ->with('success', __('question created successfully'));
        }

        return back()->with('success', __('question created successfully'));
    }

    public function edit(Course $course, Test $test, Question $question)
    {
        $this->authorize('edit', $course);

        return view('questions.edit', [
            'course' => $course,
            'test' => $test->load('lesson.unit'),
            'question' => $question,
            'questionOption' => $question->questionOptions()->get()
        ]);
    }

    public function update(QuestionRequest $request, Course $course, Test $test, Question $question)
    {
        $this->authorize('update', $course);

        $request->validated();

        if ($request->input('is_answer') == 'answer1') {
            $is_answer = [1, 0];
        } elseif ($request->input('is_answer') == 'answer2') {
            $is_answer = [0, 1];
        }

        $question->update([
            'name' => $request->name,
        ]);

        $question->questionOptions->each(function ($answer, $key) use ($request, $question, $is_answer) {

            $question->questionOptions[$key]->name = $request->answer[$key];
            $question->questionOptions[$key]->is_answer = $is_answer[$key];

            $question->questionOptions[$key]->save();
        });

        return back()->with('success',  __('question updated successfully'));
    }

    public function destroy(Course $course, Test $test, Question $question)
    {
        $this->authorize('destroy', $course);

        $test->questions()->detach($question);

        $question->questionOptions()->delete();
        $question->delete();

        return back()->with('success',  __('question deleted successfully'));
    }
}
