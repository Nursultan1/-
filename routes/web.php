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

// Route::get('/test', function () {
//     $classe = new Classe;
//     $test= App\Classe::all();
//     dd($test);
//     return view('test', compact('test'));
// });
Route::get('/t', function(){
    $te=App\Class11AEnglishLesson::all();
    return "vfdsvfd";
});
// Route::get('/test', 'TestController@index');
// Route::get('/add', 'TestController@add')->name('add');
// Route::get('/edit{name}', 'TestController@edit')->name('edit');
// // Route::any('/save', 'TestController@save')->name('save');
// // Route::get('/delete/{name}', 'TestController@delete')->name('delete');
Auth::routes();
Route::get('/home', 'HomeController@index');

Route::get('/admin', 'ClassController@admin')->name('admin');
Route::get('/delete/{id}', 'ClassController@delete')->name('delete');
Route::get('/update/{id}', 'ClassController@update')->name('update');
Route::any('/save/{id}', 'ClassController@save')->name('save');
Route::any('/newSave', 'ClassController@newSave')->name('newSave');
Route::get('/add', 'ClassController@add')->name('add');


