<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('api')->post('/user', function () {
    return 123;
});

Route::middleware('api')->get('/topics', function (Request $request) {

    $topic = \App\Topic::select('id', 'name')->where('name', 'like','%'. $request->query('q').'%')->get();
//    $topic = DB::select("select * from topics where locate ('".$request->query('q')."',name)");

    return $topic;
});
