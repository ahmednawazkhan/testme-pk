<?php

namespace App\Http\Controllers\Api\Tenant;

use Illuminate\Http\Request;
use App\Models\Tenant\Answer;
use App\Models\Tenant\Question;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Tenant\StoreAnswer;
use App\Http\Requests\Api\Tenant\UpdateAnswer;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\Tenant\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function index(Question $question)
    {
        return $question->answers();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Api\Tenant\StoreAnswer  $request
     * @param  \App\Models\Tenant\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAnswer $request, Question $question)
    {
        $answers = [];

        foreach ($request->input('answers') as $value) {
            $answers[] = [
                'label'         => $value['label'],
                'is_correct'    => $value['is_correct']
            ];
        }

        $answers = $question->answers()->createMany($answers);

        return response()->json([
            'success' => true,
            'answers' => $answers
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tenant\Question  $question
     * @param  \App\Models\Tenant\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question, Answer $answer)
    {
        return response()->json([
            'success' => true,
            'answer' => $answer
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Api\Tenant\UpdateAnswer  $request
     * @param  \App\Models\Tenant\Question  $question
     * @param  \App\Models\Tenant\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAnswer $request, Question $question, Answer $answer)
    {
        if ($answer->update($request->only(['label', 'is_correct']))) {
            return response()->json([
                'success' => true,
                'answer' => $answer
            ]);
        }

        return $this->jsonErrorRespond('failed to update', 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tenant\Question  $question
     * @param  \App\Models\Tenant\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Answer $answer)
    {
        if ($answer->delete()) {
            return response()->json([
                'success' => true,
                'answer' => $answer
            ]);
        }

        return $this->jsonErrorRespond('failed to delete', 500);
    }
}
