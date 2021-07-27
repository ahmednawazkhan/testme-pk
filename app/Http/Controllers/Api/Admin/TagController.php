<?php

namespace App\Http\Controllers\Api\Tenant;

use App\Models\Tenant\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();

        return response()->json([
            'success' => true,
            'tags' => $tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tag = Tag::create([
            'name' => $request->input('name'),
            'slug' => str_slug($request->input('name')),
            'is_menu' => $request->input('is_menu')
        ]);

        return response()->json([
            'success' => true,
            'tag' => $tag
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tenant\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        return response()->json([
            'success' => true,
            'tag' => $tag->load(['categories'])
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tenant\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        if ($tag->update([
            'name' => $request->input('name'),
            'slug' => str_slug($request->input('name')),
            'is_menu' => $request->input('is_menu')
        ])) {
            return response()->json([
                'success' => true,
                'tag' => $tag
            ]);
        }

        return $this->jsonErrorRespond('failed to update', 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tenant\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        if ($tag->delete()) {
            return response()->json([
                'success' => true,
                'tag' => $tag
            ]);
        }

        return $this->jsonErrorRespond('failed to delete');
    }
}
