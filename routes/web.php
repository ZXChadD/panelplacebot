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

Route::get('/', function () {
    return view('welcome');
});

Route::match(['get', 'post'], '/botman', 'BotManController@handle');
Route::get('/botman/tinker', 'BotManController@tinker');

//Route::post('/slack', function(\Illuminate\Http\Request $request){
//
//    $payload = $request->json();
//
//    if ($payload->get('type') === 'url_verification') {
//        return $payload->get('challenge');
//    }
//
//    // Bot logic will be placed here
//});