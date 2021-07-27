<?php

namespace App\Http\Controllers\Api\Tenant;

use Illuminate\Http\Request;
use App\Models\Tenant\Chapter;
use App\Models\Tenant\Subject;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Tenant\StoreChapter;

class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tenant\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Subject $subject)
    {
        return response()->json([
            'success' => true,
            'chapters' => $subject->chapters()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Api\Tenant\StoreChapter  $request
     * @param  \App\Models\Tenant\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChapter $request, Subject $subject)
    {
        $chapter = $subject->chapters()
            ->create(['name' => $request->input('label')]);

        return response()->json([
            'success' => true,
            'chapter' => $chapter
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tenant\Subject  $subject
     * @param  \App\Models\Tenant\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject, Chapter $chapter)
    {
        $chapter->name = $request->input('label');

        if ($chapter->save()) {
            return response()->json([
                'success' => true,
                'chapter' => $chapter
            ]);
        }

        return $this->jsonErrorRespond('Failed updating the chapter', 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tenant\Subject  $subject
     * @param  \App\Models\Tenant\Chapter  $chapter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject, Chapter $chapter)
    {
        if ($chapter->delete()) {
            return response()->json([
                'success' => true,
                'chapter' => $chapter
            ]);
        }

        return $this->jsonErrorRespond('Failed to delete chapter');
    }
}
