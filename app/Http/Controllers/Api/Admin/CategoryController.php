<?php

namespace App\Http\Controllers\Api\Tenant;

use Illuminate\Http\Request;
use App\Models\Tenant\Category;
use App\Models\Tenant\Tag;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Tag $tag)
    {
        return response()->json(
            [
                'success' => true,
                'categories' => $tag->categories
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Tag $tag)
    {
        $category = $tag->categories()->create([
            'name'          => $request->input('name'),
            'slug'          => str_slug($request->input('name')),
            'description'   => $request->input('description')
        ]);

        return response()->json([
            'success'   => true,
            'category'  => $category
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tenant\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag, Category $category)
    {
        return response()->json([
            'success' => true,
            'category' => $category->load(['tests', 'tag'])
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tenant\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag, Category $category)
    {
        if ($category->update([
            'name'          => $request->input('name'),
            'slug'          => str_slug($request->input('name')),
            'description'   => $request->input('description')
        ])) {
            return response()->json([
                'success'   => true,
                'category'  => $category
            ]);
        }

        return $this->jsonErrorRespond('failed update category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tenant\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag, Category $category)
    {
        if ($category->delete()) {
            return response()->json([
                'success'   => true,
                'category'  => $category
            ]);
        }

        return $this->jsonErrorRespond('failed to destroy');
    }
}
