<?php

namespace App\Http\Controllers;

use App\Classe;
use App\User;
use App\Teache;
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
        // dd($classes);
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
        return view('add');
    }
    function admin(){ 
        $classList=array();
        $classes=Classe::all();
        $i=0;
        foreach($classes as $class){
            $classList["$i"]=array(
                'id'=>$class->id_class,
                'name'=>$class->class_name_numbe."_".$class->class_name_categori."-класс",
                'teache'=>Teache::find($class->id_teache)->fio_teache,
            );
            $i++;
        }
        // dd($classList);
        // foreach($classList as $cl){
        //     echo $cl->fio_teache;
        // }
        return view('admin',compact('classList'));
    }
    function delete($id){
        Classe::destroy($id);
        return redirect('admin');
    }
    function update($id){
        $class =Classe::find($id);
        $inf=array(
            'id'=>$class->id_class,
            'nomer' =>$class->class_name_numbe,
            'bukva'=>$class->class_name_categori,
            'nameTeache' =>Teache::find($class->id_teache)->fio_teache
        );
                
        return view('update',compact('inf'));
    }
    function save(Request $request, $id=false){
        $nomer = $request->input('nomer');
        $bukva = $request->input('bukva');
        $teache = $request->input('teache');
        $class =Classe::find($id);
        $class->class_name_numbe="$nomer";
        $class->class_name_categori="$bukva";
        $class->save();
        return redirect('admin');
    }
    function newSave(Request $request){
        $nomer = $request->input('nomer');
        $bukva = $request->input('bukva');
        $teache = $request->input('teache');
        $class =new Classe;
        $class->class_name_numbe="$nomer";
        $class->class_name_categori="$bukva";
        $class->id_teache="1";
        $class->save();
        return redirect('admin');
    }
}
