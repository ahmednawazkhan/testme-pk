<?php

namespace App\Http\Controllers\Api\Tenant;

use Illuminate\Http\Request;
use App\Models\Tenant\Question;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Tenant\StoreQuestion;
use App\Http\Requests\Api\Tenant\UpdateQuestion;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->input('search', null);
        $builder = Question::with(['answers', 'chapter.subject.chapters']);

        if ($query) {
            $builder = $builder->where('label', 'like', "%$query%");
        }

        $questions = $builder->get();

        return response()->json([
            'success'   => true,
            'questions' => $questions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Api\Tenant\StoreQuestion  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestion $request)
    {
        // create question
        $question = Question::create([
            'label' => $request->input('label'),
            'is_multiple_choice' => $request->input('multiple_choice'),
            'explanation' => $request->input('explaination'),
            'chapter_id' => $request->input('chapter_id')
        ]);

        $answers = [];

        foreach ($request->input('answers') as $value) {
            $answers[] = [
                'label'         => $value['label'],
                'is_correct'    => $value['is_correct']
            ];
        }

        $question->answers()->createMany($answers);

        return response()->json([
            'success' => true,
            'question' => $question->load(['answers', 'chapter.subject.chapters'])
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tenant\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return response()->json([
            'success' => true,
            'question' => $question->load(['answers', 'chapter.subject.chapters'])
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Api\Tenant\UpdateQuestion  $request
     * @param  \App\Models\Tenant\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuestion $request, Question $question)
    {
        if ($question->update([
            'label' => $request->input('label'),
            'is_multiple_choice' => $request->input('multiple_choice'),
            'explanation' => $request->input('explaination'),
            'chapter_id' => $request->input('chapter_id')
        ])) {
            $question->answers()->delete();

            $answers = [];

            foreach ($request->input('answers') as $value) {
                $answers[] = [
                    'label'         => $value['label'],
                    'is_correct'    => $value['is_correct']
                ];
            }

            $question->answers()->createMany($answers);

            return response()->json([
                'success' => true,
                'question' => $question->load('answers')
            ]);
        }

        return $this->jsonErrorRespond('failed updating', 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tenant\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        if ($question->delete()) {
            return response()->json([
                'success' => true,
                'question' => $question
            ]);
        }

        return $this->jsonErrorRespond('failed deleting question', 500);
    }
}
