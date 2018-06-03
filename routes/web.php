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
Route::get('/home', 'HomeController@index');

// админ
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::get('/', 'ClassController@admin')->name('admin');
    Route::get('/update-class/{id}', 'ClassController@updateClass')->name('update-class');
    Route::any('/save-class', 'ClassController@saveClass')->name('save-class');
    Route::get('/add-class', 'ClassController@addClass')->name('add-class');
    Route::get('/delete-class/{id}', 'ClassController@deleteClass')->name('delete-class');


    // Ученики
    Route::get('/pupils/{id}', 'PupilController@pupils')->name('pupils');
    Route::post('/pupil-save', 'PupilController@save');
    Route::post('/delete-pupil/{classId}/{idPupil}', 'PupilController@destroy')->name('delete-pupil');

    // предметы
    Route::get('/items/{id}', 'ItemController@index')->name('items');

    //ajax Items   
    Route::get('/items/ajax/{className}', 'ItemController@ajaxRead');
    Route::any('/items/ajax/save/{className}', 'ItemController@ajaxSave');
    Route::any('/items/ajax/update/{className}', 'ItemController@ajaxUpdate');
    Route::any('/items/ajax/delete/{className}/{id_item}', 'ItemController@ajaxDelete');
    Route::get('/items/ajax/readteaches', 'TeacheController@ajaxRead');


    

    // AJAX pupils
        /* имя класса приходить формате 1_а 
         */
        Route::get('/pupils/ajax/{className}', 'PupilController@ajaxRead');
        Route::any('/pupils/ajax/save/{className}', 'PupilController@ajaxSave');
        Route::any('/pupils/ajax/update/{className}', 'PupilController@ajaxUpdate');
        Route::any('/pupils/ajax/delete/{className}', 'PupilController@ajaxDelete');


    // Преподователи
    Route::get('/teache', 'TeacheController@show')->name('teache');

    // маршруты для ajax запросов для админки преподователей
        Route::get('/teache/ajax-read', 'TeacheController@ajaxRead');
        Route::post('/teache/ajax-update', 'TeacheController@ajaxUpdate');
        Route::post('/teache/ajax-delete', 'TeacheController@ajaxDelete');
        // для получения запросов на добвления в преподователи
        Route::get('/teache/ajax-read-request', 'TeacheController@ajaxReadRequest');
        Route::post('/teache/ajax-request-config', 'TeacheController@ajaxRequestConfig');


});


// простым пользователям
Route::group(['middleware' => 'auth'], function(){

    Route::get('/','ClassController@index');
    // ajax запросы
        Route::get('/classes/{number}','ClassController@ajaxGetClasses');
        Route::get('/items/{id_class}','ClassController@ajaxGetItems');


    // журнал
    Route::get('/journal/{id_class}/{id_item}','JournalController@index');
});