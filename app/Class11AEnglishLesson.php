<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Class11AEnglishLesson extends Model
{
    // изменяет имя таблицы по умолчанию
    protected $table = 'class_11_a_english_lessons'; 

    // Отключает запис о последних изменених
    public $timestamps = false;

    /**
     *  $flights = App\Flight::where('active', 1)
     *                         ->orderBy('name', 'desc')
     *                         ->take(10)
     *                         ->get();    
     */
}
