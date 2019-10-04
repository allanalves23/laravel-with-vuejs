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

Route::get('/{vue_capture?}/{vue_capture2?}', function () {
    return view('layouts.app');
})->where('vue-capture', '[\/\w\.-]*')->where('vue_capture2',  '[\/\w\.-]*');

Route::get('/', function () {
    return view('layouts.app');
});
