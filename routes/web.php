<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();
Route::get('/', 'QuestionsController@index');
Route::get('email/verify/{token}', [
    'as'   => 'email.verify',
    'uses' => 'EmailController@verify',
]);

Route::Resource('/questions', 'QuestionsController', [
    'names'  => [
        'create' => 'question.create',
        'show'   => 'question.show',
        'index'  => 'question.index'
    ]

]);
Route::post('/questions/{question}/answer', 'AnswersController@store');

Route::get('/questions/{question}/follow', 'QuestionFollowController@follow');

Route::get('notifications','NotificationsController@index');

Route::get('inbox', 'InBoxController@index');