<?php

namespace App\Http\Controllers\Api\Tenant;

use Illuminate\Http\Request;
use App\Models\Tenant\Subject;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Tenant\StoreSubject;
use App\Http\Requests\Api\Tenant\UpdateSubject;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::with(['chapters'])->get();

        return response()->json([
            'success' => true,
            'subjects' => $subjects
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Api\Tenant\StoreSubject  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubject $request)
    {
        $subject = new Subject(['name' => $request->input('label')]);

        if ($subject->save()) {
            return response()->json([
                'success' => true,
                'subject' => $subject->load(['chapters'])
            ]);
        }

        return response()->json([
            'success' => false,
            'errors' => 'An error occured'
        ], 500);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Api\Tenant\UpdateSubject  $request
     * @param  \App\Models\Tenant\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubject $request, Subject $subject)
    {
        $subject->name = $request->input('label');

        if ($subject->save()) {
            return response()->json([
                'success' => true,
                'subject' => $subject->load(['chapters'])
            ]);
        }

        return $this->jsonErrorRespond('Fail updating subject', 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tenant\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        if ($subject->delete()) {
            return response()->json([
                'success' => true,
                'subject' => $subject
            ]);
        }

        return $this->jsonErrorRespond('Failed to delete', 500);
    }
}
