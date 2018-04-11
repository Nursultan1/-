<?php

namespace App\Http\Controllers;

use App\Classe;
use Artisan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class ClassController extends Controller
{
    function getControllerName( $object ){
        $$controllerName="Class".$object->class_name_numbe.strtoupper($object->class_name_categori)."ItemController";
        return $controllerName;
    }
    function index(){
        $classes=Classe::all();
        $classList=array(
            '1'=>"",
            '2'=>"",
            '3'=>"",
            '4'=>"",
            '5'=>"",
            '6'=>"",
            '7'=>"",
            '8'=>"",
            '9'=>"",
            '10'=>"",
            '11'=>""
        );
        // $classList=array();
        // foreach($classes as $classe){
        //    echo "Class".$classe->class_name_numbe.strtoupper($classe->class_name_categori)."ItemController";
        // }
        for($i=1;$i<12;$i++){
            $classList["$i"]=Classe::where('class_name_numbe',$i)->get();
        }
        // $classList['1']=Classe::where('class_name_numbe',11)->get();
        return view('index',compact('classList'));
    }
    function add(){
        
        return view('test');
    }
    
}
