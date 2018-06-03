<?php

namespace App\Http\Controllers;
use DB;
use App\Classe;
use App\User;
use App\Teache;
use Artisan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class ClassController extends Controller
{
    function index(){
        return view('index');
    }


    function ajaxGetClasses($number){
        
        $result = array('error' => false);
        $classes=DB::table('classes')->where('class_name_numbe','=',"$number")->get();
        foreach($classes as $class){
            $result['classes'][]=array(
                'id_class'=>$class->id_class,
                'class_name_category'=>$class->class_name_categori
            );
        }
        if(!isset($result['classes'])){
            $result['message']="Классы не найдены";
            $result['error']=true;
        }
        header("Content-type: application/json");
        echo json_encode($result);
    }

    function ajaxGetItems($id_class){
        $result = array('error' => false);
        try {
            $class=DB::table('classes')->where('id_class','=', "$id_class")->first();
            $items=DB::table("class".$class->class_name_numbe."_".$class->class_name_categori."_items")->get();
            foreach($items as $item){
                $result['items'][]=array(
                    'id_item'=>$item->id_predmet,
                    'name'=>$item->name_predmet_ru
                );
            }
        }
        catch (\Exception $e) {
            $result['message']="Для этого класса еще не добавлены предметы";
            $result['error']=true;
        }

        // if(!isset($result['items'])){
        //     $result['message']="Для этого класса еще не добавлены предметы";
        //     $result['error']=true;
        // }
        header("Content-type: application/json");
        echo json_encode($result);
    }




    // админ
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
        return view('admin/admin',compact('classList'));
    }
    function addClass(){
        $teaches=Teache::All();
        return view('admin/add-update-class',compact('teaches'));
    }
    function updateClass($id){
        $classDB=Classe::find($id);
        $class=array(
            'id'=>$classDB->id_class,
            'numbe'=>$classDB->class_name_numbe,
            'category'=>$classDB->class_name_categori,
            'teacheCurrent'=>Teache::find($classDB->id_teache)->fio_teache,
            'teacheCurrentID'=>Teache::find($classDB->id_teache)->id_teache,
            'teaches'=>Teache::All()
        );
        return view('admin/add-update-class',compact('class'));
    }
    function saveClass(Request $request){
        $numbe=$request->input('numbe');
        $category=$request->input('category');
        $teache=$request->input('teache');
        $id=$request->input('id');
        if(isset($id)){
            $class =Classe::find($id);
            $items=DB::select("select id_predmet from class".$class->class_name_numbe."_".$class->class_name_categori."_items");
            foreach($items as $item){
                DB::statement("ALTER TABLE  class".$class->class_name_numbe."_".$class->class_name_categori."_".$item->id_predmet."_lesson_assessments
                    RENAME TO class".$numbe."_".$category."_".$item->id_predmet."_lesson_assessments
                ");
                DB::statement("ALTER TABLE  class".$class->class_name_numbe."_".$class->class_name_categori."_".$item->id_predmet."_lessons
                    RENAME TO class".$numbe."_".$category."_".$item->id_predmet."_lessons
                ");
            }
            DB::statement("ALTER TABLE class".$class->class_name_numbe."_".$class->class_name_categori."_pupils RENAME TO class".$numbe."_".$category."_pupils");
            DB::statement("ALTER TABLE class".$class->class_name_numbe."_".$class->class_name_categori."_items RENAME TO class".$numbe."_".$category."_items");
        }
        else{
            $class =new Classe;
            DB::statement("create table class".$numbe."_".$category."_pupils(id_pupil int primary key AUTO_INCREMENT, fio_pupil varchar(120))");
            DB::statement("create table class".$numbe."_".$category."_items(id_predmet int PRIMARY KEY AUTO_INCREMENT, id_teache int,FOREIGN KEY(id_teache) REFERENCES teaches(id_teache), name_predmet_eng varchar(50), name_predmet_ru varchar(50))");
        }
        $class->id_teache="$teache";
        $class->class_name_numbe="$numbe";
        $class->class_name_categori="$category";
        $class->save();
        return redirect('admin/');
    }
    function deleteClass($id){
        $class =Classe::find($id);
        $items=DB::select("select id_predmet from class".$class->class_name_numbe."_".$class->class_name_categori."_items");
        foreach($items as $item){
            DB::statement("DROP TABLE class".$class->class_name_numbe."_".$class->class_name_categori."_".$item->id_predmet."_lesson_assessments");
            DB::statement("DROP TABLE class".$class->class_name_numbe."_".$class->class_name_categori."_".$item->id_predmet."_lessons");
        }
        DB::statement("drop table class".$class->class_name_numbe."_".$class->class_name_categori."_pupils");
        DB::statement("drop table class".$class->class_name_numbe."_".$class->class_name_categori."_items");
        Classe::destroy($id);
        return redirect('admin/');
    }
}
