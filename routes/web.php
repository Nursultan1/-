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
Route::get('/', 'ClassController@index');
Route::get('/test', function () {
    $classe = new Classe;
    // for(){
    //     for(){

    //     }
    // }
    $test= App\Classe::all();
    dd($test);
    return view('test', compact('test'));
});

Auth::routes();

Route::get('/home', 'HomeController@index');
