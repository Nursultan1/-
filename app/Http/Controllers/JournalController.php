<?php

namespace App\Http\Controllers;
use DB;
use App\Classe;
use App\User;
use App\Teache;
use Artisan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class JournalController extends Controller
{
    function index($id_class, $id_item){
        $class=DB::table('classes')->where('id_class','=', "$id_class")->first();
        $className="class".$class->class_name_numbe."_".$class->class_name_categori;
        $assessmentTable=$className."_";
        $pupilList=DB::table("$className"."_pupils")->select('id_pupil', 'fio_pupil')->get();
        $assessment=DB::select("select");
        $data=array(
            'className'=>$className,
            'pupilList'=>$pupilList,
        );
        return view('journal',compact('data'));
    }
}