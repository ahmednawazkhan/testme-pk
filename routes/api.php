<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'namespace'     => 'Api',
], function () {
    Route::group([
        'namespace' => 'Auth',
        'prefix' => 'auth'
    ], function () {
        Route::post('login', 'AuthController@login');
        Route::post('register', 'AuthController@register');
        Route::get('user', 'AuthController@user')->middleware(['jwt.auth']);
        Route::get('refresh', 'AuthController@refresh')->middleware(['jwt.refresh']);
        Route::post('logout', 'AuthController@logout')->middleware(['jwt.auth']);
        Route::post('confirmation/resend', 'VerificationController@resend');
        Route::get('confirmation/verify', 'VerificationController@verify');
    });

    // Admin routes
    Route::group([
        'namespace' => 'Admin',
        'prefix' => 'admin',
        'middleware' => ['jwt.auth']
    ], function () {
        Route::apiResources([
            'subjects'          => 'SubjectController',
            'subjects.chapters' => 'ChapterController',
            'questions'         => 'QuestionController',
            'questions.answers' => 'QuestionController',
            'tags'              => 'TagController',
            'tags.categories'   => 'CategoryController',
            'tags.categories.tests'   => 'TestController',
        ]);
        Route::apiResource('tags.categories.tests.questions', 'TestQuestionController')
             ->only(['index', 'store']);
        Route::apiResource('roles', 'RolesController')
             ->only(['index', 'store']);
    });

    // Tenant routes
    Route::group([
        'namespace' => 'Tenant',
        'prefix' => 'agency',
        'middleware' => ['jwt.auth']
    ], function () {
        Route::apiResources([
            'subjects'          => 'SubjectController',
            'subjects.chapters' => 'ChapterController',
            'questions'         => 'QuestionController',
            'questions.answers' => 'QuestionController',
            'tags'              => 'TagController',
            'tags.categories'   => 'CategoryController',
            'tags.categories.tests'   => 'TestController',
        ]);
        Route::apiResource('tags.categories.tests.questions', 'TestQuestionController')
             ->only(['index', 'store']);
        Route::apiResource('roles', 'RolesController')
             ->only(['index', 'store']);
    });
});
