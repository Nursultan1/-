<?php

namespace App\Http\Controllers;
use DB;
use App\Classe;
use App\User;
use App\Teache;
use Artisan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    function index($id){
        $class=DB::table('classes')->where('id_class','=', "$id")->first();
        $className=$class->class_name_numbe."_".$class->class_name_categori;

        //$items= DB::select("select $itemTabName.id_predmet, teaches.fio_teache, $itemTabName.name_predmet_ru  from $itemTabName left join teaches on $itemTabName.id_teache=teaches.id_teache");
        return view('admin/item',compact('className'));
    }
    function ajaxRead($className){
        $result = array(
            'error' => false,
            'message'=>''
        );
        $tabName="class$className"."_items";
        $items= DB::select("select $tabName.id_predmet, teaches.fio_teache,$tabName.name_predmet_eng,$tabName.name_predmet_ru  from $tabName left join teaches on $tabName.id_teache=teaches.id_teache");
        foreach($items as $item){
            $result['items'][]=array(
                'id_item'=>$item->id_predmet,
                'name_eng'=>$item->name_predmet_eng,
                'name_ru'=>$item->name_predmet_ru,
                'teache'=>$item->fio_teache
            );
        }
        header("Content-type: application/json");
        echo json_encode($result);
    }
    function ajaxSave(Request $request,$className){
        $id_teache=$request->input('id_teache');
        $name_ru=$request->input('name_ru');
        $name_eng=$request->input('name_eng');
        $tabName="class$className"."_items";

        DB::table("$tabName")->insert(
            ['id_teache' => "$id_teache", 'name_predmet_eng' => "$name_eng",'name_predmet_ru' => "$name_ru"]
        );
        $id_item=DB::table("$tabName")->where('name_predmet_ru','=', "$name_ru")->first();
        $id_item=$id_item->id_predmet;
        DB::statement("create table class$className"."_$id_item"."_lessons(
            id_lesson int primary key AUTO_INCREMENT,
            id_teache int,
            date date,
            plan varchar(250),
            foreign key(id_teache) REFERENCES teaches(id_teache)
        )");


        DB::statement("create table class$className"."_$id_item"."_lesson_assessments(
            id_osenka int primary key AUTO_INCREMENT,
            id_lesson int,
            id_pupil int,
            osenka int,
            attendance varchar(5),
            foreign key(id_lesson) REFERENCES class$className"."_$id_item"."_lessons(id_lesson),
            foreign key(id_pupil ) REFERENCES class$className"."_pupils(id_pupil)
        )");
        $result = array(
            'error' => false,
            'message'=>'Дынные успешно сохранены',
            'id_teache'=>$id_teache,
            'name_ru'=>$name_ru,
            'name_eng'=>$name_eng,
            'tabName'=>$tabName,
        );
        header("Content-type: application/json");
        echo json_encode($result);
    }
    function ajaxUpdate(Request $request,$className){
        $id_item=$request->input('id_item');
        $id_teache=$request->input('id_teache');
        $name_ru=$request->input('name_ru');
        $name_eng=$request->input('name_eng');
        $tabName="class$className"."_items";
        DB::update("update $tabName set id_teache ='$id_teache',name_predmet_eng ='$name_eng',name_predmet_ru ='$name_ru' where id_predmet='$id_item'");
        $result = array(
            'error' => false,
            'message'=>'',
        );
        header("Content-type: application/json");
        echo json_encode($result);
    }
    function ajaxDelete($className, $id_item){
        $tabName="class$className"."_items";
        DB::statement("DROP TABLE class$className"."_$id_item"."_lesson_assessments");
        DB::statement("drop table class$className"."_$id_item"."_lessons");
        $deleted = DB::delete("delete from $tabName where id_predmet='$id_item'");
        $result = array(
            'error' => false,
            'message'=>'',
        );
        header("Content-type: application/json");
        echo json_encode($result);
    }

    function readU(){
        $id_teache=Auth::user()->id_teache;
        $classes=Classe::all();
        $data=array();
        foreach($classes as $classe){
            $itemTabNAme="class".$classe->class_name_numbe."_".$classe->class_name_categori."_items";
            $items=DB::select("select * from $itemTabNAme where id_teache='$id_teache'");
            foreach($items as $item){
                $data[]=array(
                    'class'=>$classe->class_name_numbe."_".$classe->class_name_categori."-класс",
                    'itemName'=>$item->name_predmet_ru
                );
            }
        }
        return view('item', compact('data'));
        // dd($data);
    }
}
