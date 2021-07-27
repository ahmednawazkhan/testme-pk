<?php

namespace App\Http\Controllers\Api\Tenant;

use App\Models\Tenant\Test;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tenant\Tag;
use App\Models\Tenant\Category;

class TestQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Tag $tag, Category $category, Test $test)
    {
        return response()->json([
            'success' => true,
            'questions' => $test->load(['questions.chapter'])->questions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Tag $tag, Category $category, Test $test)
    {
        if ($test->questions()->sync($request->input('questions'))) {
            return response()->json([
                'success' => true,
                'questions' => $test->questions
            ]);
        }

        return $this->jsonErrorRespond('failed to sync questions', 500);
    }
}
