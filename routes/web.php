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

Route::get('notifications','NotificationsMessageController@index');
Route::get('notifications/{notification}','NotificationsMessageController@show');

Route::get('/user/avatar','UserController@avatar');
Route::get('avatar','UserController@avatar');
Route::post('avatar','UserController@changeAvatar');
Route::post('/user/avatar','UserController@changeAvatar');

Route::get('inbox', 'InBoxController@index');
Route::get('inbox/{diaglog}', 'InBoxController@show');
Route::post('inbox/{diaglog}/store', 'InBoxController@store');

Route::get('password','PasswordController@index');
Route::post('/password/update','PasswordController@update')->name('password');


Route::get('setting','SettingController@index');
Route::post('setting','SettingController@store')->name('setting');
