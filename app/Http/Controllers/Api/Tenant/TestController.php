<?php

namespace App\Http\Controllers\Api\Tenant;

use App\Models\Tenant\Test;
use App\Models\Tenant\Category;
use App\Models\Tenant\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Tag $tag, Category $category)
    {
        return response()->json([
            'success' => true,
            'tests' => Test::with(['questions'])
                           ->where('category_id', $category->id)
                           ->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Tag $tag, Category $category)
    {
        $test = $category->tests()->create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'instructions' => $request->input('instructions'),
            'minutes' => $request->input('minutes'),
            'is_free' => $request->input('is_free'),
            'amount' => $request->input('amount'),
        ]);

        return response()->json([
            'success' => true,
            'test' => $test
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tenant\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag, Category $category, Test $test)
    {
        return response()->json([
            'success' => true,
            'test' => $test->load(['questions.chapter', 'questions.answers'])
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tenant\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag, Category $category, Test $test)
    {
        if ($test->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'instructions' => $request->input('instructions'),
            'minutes' => $request->input('minutes'),
            'is_free' => $request->input('is_free'),
            'amount' => $request->input('amount'),
        ])) {
            return response()->json([
                'success'   => true,
                'test'  => $test
            ]);
        }

        return $this->jsonErrorRespond('failed update test', 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tenant\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag, Category $category, Test $test)
    {
        if ($test->delete()) {
            return response()->json([
                'success'   => true,
                'test'  => $test
            ]);
        }

        return $this->jsonErrorRespond('failed to destroy', 500);
    }
}
