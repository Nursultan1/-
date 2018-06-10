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
use DateTime;
use DateInterval;


class JournalController extends Controller
{

    function object_to_array($data){
        if (is_array($data) || is_object($data))
        {
            $result = array();
            foreach ($data as $key => $value)
            {
                $result[$key] = $this->object_to_array($value);
            }
            return $result;
        }
        return $data;
    }


    public $month=array(
        1=>'Январь',
        2=>"Февраль",
        3=>"Март",
        4=>"Апрель",
        5=>"Май",
        6=>"Июнь",
        7=>"Июль",
        8=>"Август",
        9=>"Сетябрь",
        10=>"Октябрь",
        11=>"Ноябрь",
        12=>"Декабрь",
    );
    function index($id_class, $id_item){
        $class=DB::table('classes')->where('id_class','=', "$id_class")->first();
        $className=$class->class_name_numbe."_".$class->class_name_categori;
        $data=array(
            'className'=>$className,
            'id_item'=>$id_item
        );
        return view('journal',compact('data'));
    }


    function ajaxGetLessons($className, $id_item){
        $response=array(
            'error'=>false,
            'errorMes'=>"",
        );

        //получения номер ученика как в журнале
        $pupils = DB::select("select * from class".$className."_pupils order by fio_pupil");
        $pupilsArray=array();
        $idInjournal=0;
        foreach($pupils as $pupil){
            $pupilsArray[$pupil->id_pupil]=$idInjournal;
            $idInjournal++;
        }


        $lessonsTableName="class$className"."_".$id_item."_lessons";
        $osenkaTableName="class$className"."_".$id_item."_lesson_assessments";

        $lessons=DB::select("select * from $lessonsTableName, $osenkaTableName where $lessonsTableName.id_lesson=$osenkaTableName.id_lesson");
        $dates=DB::select("select date from $lessonsTableName order by date");

        $data=array();
        foreach($dates as $date){

            $lessonsByDate=$this->object_to_array(DB::select("select * from $lessonsTableName, $osenkaTableName 
                                        where $lessonsTableName.id_lesson=$osenkaTableName.id_lesson and 
                                        $lessonsTableName.date='$date->date'"));
            
                                       
            if(empty($lessonsByDate)){
                $lessonsByDate=$this->object_to_array(DB::select("select * from $lessonsTableName 
                                        where  $lessonsTableName.date='$date->date'"));
            }
            $objDateTime = new DateTime($date->date);
            $tmpArray=array();
            foreach($lessonsByDate as $les){
                if(count($les)>5){
                    if($les['attendance']==null){
                        $tmpArray[$pupilsArray[$les['id_pupil']]]=$les['osenka'];
                    }
                    else{
                        $tmpArray[$pupilsArray[$les['id_pupil']]]=$les['attendance'];
                    }
                }
                else{
                    $tmpArray[]=null;
                }
            }
            $currentDateTime=new DateTime();
            $tmpDateTime=$objDateTime;
            $tmpDateTime->add(new DateInterval('PT45M'));
            if($currentDateTime>$tmpDateTime){
                $data[$objDateTime->format("n")][]=array(
                    'day'=>$objDateTime->format("j"),
                    'hour'=>$objDateTime->format("G"),
                    'id_lesson'=>$les['id_lesson'],
                    'data'=>$tmpArray,
                    'currentLesson'=>false
                );
            }
            else{
                $data[$objDateTime->format("n")][]=array(
                    'day'=>$objDateTime->format("j"),
                    'hour'=>$objDateTime->format("G"),
                    'id_lesson'=>$les['id_lesson'],
                    'data'=>$tmpArray,
                    'currentLesson'=>true
                );
            }
            $tmpArray=null;
        }
        $response['data']=$data;
        echo json_encode($response);
    }

    function ajaxGetPlan($className, $id_item){
        $response=array(
            'error'=>false,
            'errorMes'=>"",
        );

        $lessonsTableName="class$className"."_".$id_item."_lessons";
        
        $planObj=DB::select("select * from $lessonsTableName order by date");
        $plan=array();
        foreach($planObj as $less){
            $tmpDate = new DateTime($less->date);
            $plan[]=array(
                'id_lesson'=>$less->id_lesson,
                'date'=>$tmpDate->format("m.d"),
                'plan'=>$less->plan,
            );
        }

        $response['data']=$plan;
        echo json_encode($response);
    }
    
    function ajaxCreateLesson($className, $id_item, Request $request){
        $plan=$request->input('plan');
        $response=array(
            'error'=>false,
            'errorMes'=>"",
        );
        $itemsTableName="class$className"."_items";
        $id_teache=Auth::user()->id_teache;
        $items=DB::select("select * from $itemsTableName where id_predmet='$id_item' and id_teache='$id_teache' ");
        if(!empty($items)){
            $date = new DateTime();
            $tmp= $date->format('Y-m-d H:i:s');
            $lessonsTableName="class$className"."_".$id_item."_lessons";
            DB::insert("insert into $lessonsTableName(date, plan) values('$tmp','$plan')");
        }
    
        header("Content-type: application/json");
        echo json_encode($response);
    }

    function ajaxAddAssess($className, $id_item, Request $request){

        //получения имя таблицы
        $lessonsTableName="class$className"."_".$id_item."_lessons";
        $osenkaTableName="class$className"."_".$id_item."_lesson_assessments";

        $response=array(
            'error'=>false,
            'errorMes'=>"",
        );

        //получения id урока
        $dateTimeMinutesAgo = new DateTime("45 minutes ago");
        $strData= $dateTimeMinutesAgo->format("Y-m-d H:i:s");
        $dates=DB::select("select * from $lessonsTableName where date>'$strData'");
        $id_lesson=$dates[0]->id_lesson;

        $id_pupil=$request->input('id_pupil');
        $assess=$request->input('assess');
        $attendance=$request->input('attendance');
        
        $checkAssess=DB::select("select * from $osenkaTableName where id_lesson='$id_lesson' and id_pupil='$id_pupil'");
        if(!empty($checkAssess)){
            if(!empty($assess)){
                DB::update("update $osenkaTableName set osenka='$assess', attendance=null 
                            where id_lesson='$id_lesson' and id_pupil='$id_pupil'");
            }
            else{
                DB::update("update $osenkaTableName set osenka=null, attendance='$attendance' 
                            where id_lesson='$id_lesson' and id_pupil='$id_pupil'");
            }
        }
        else{

            if(!empty($assess)){
                DB::insert("insert into $osenkaTableName(id_lesson,id_pupil,osenka) 
                            values('$id_lesson','$id_pupil','$assess')");
            }
            else{
                DB::insert("insert into $osenkaTableName(id_lesson,id_pupil,attendance) 
                values('$id_lesson','$id_pupil','$attendance')");
            }

        }


        
        
        
        header("Content-type: application/json");
        echo json_encode($response);
    }

    function ajaxgetNameItem($className,  $id_item){
        $response=array(
            'error'=>false,
            'errorMes'=>"",
        );

        $itemsTableName="class$className"."_items";
        $items=DB::select("select * from $itemsTableName where id_predmet='$id_item'");
        $response['nameItem']=$items[0]->name_predmet_ru;
        header("Content-type: application/json");
        echo json_encode($response);
    }


    function test($className,  $id_item){
        // $dateTimeMinutesAgo = new DateTime("45 minutes ago");
        // $strData= $dateTimeMinutesAgo->format("Y-m-d H:i:s");
        // $lessonsTableName="class$className"."_".$id_item."_lessons";
        // $dates=DB::select("select * from $lessonsTableName where date>'$strData'");
        // $id_lesson=$dates[0]->id_lesson;
        // echo $id_lesson;
        // var_dump($dates);  
        
        
        var_dump(Auth::user());

        // //получения номер ученика как в журнале
        // $pupils = DB::select("select * from class".$className."_pupils order by fio_pupil");
        // $pupilsArray=array();
        // $idInjournal=0;
        // foreach($pupils as $pupil){
        //     $pupilsArray[$pupil->id_pupil]=$idInjournal;
        //     $idInjournal++;
        // }


        // $lessonsTableName="class$className"."_".$id_item."_lessons";
        // $osenkaTableName="class$className"."_".$id_item."_lesson_assessments";

        // $lessons=DB::select("select * from $lessonsTableName, $osenkaTableName where $lessonsTableName.id_lesson=$osenkaTableName.id_lesson");
        // $dates=DB::select("select date from $lessonsTableName order by date");
        // $data=array();
        // foreach($dates as $date){

        //     $lessonsByDate=$this->object_to_array(DB::select("select * from $lessonsTableName, $osenkaTableName 
        //                                 where $lessonsTableName.id_lesson=$osenkaTableName.id_lesson and 
        //                                 $lessonsTableName.date='$date->date'"));
            
                                       
        //     if(empty($lessonsByDate)){
        //         $lessonsByDate=$this->object_to_array(DB::select("select * from $lessonsTableName 
        //                                 where  $lessonsTableName.date='$date->date'"));
        //     }
        //     $objDateTime = new DateTime($date->date);
        //     $tmpArray=array();
        //     foreach($lessonsByDate as $les){
        //         if(count($les)>5){
        //             if($les['attendance']==null){
        //                 $tmpArray[$pupilsArray[$les['id_pupil']]]=$les['osenka'];
        //             }
        //             else{
        //                 $tmpArray[$pupilsArray[$les['id_pupil']]]=$les['attendance'];
        //             }
        //         }
        //         else{
        //             $tmpArray[]=null;
        //         }
        //     }
        //     $currentDateTime=new DateTime();
        //     $objDateTime->add(new DateInterval('PT45M'));
        //     if($currentDateTime>$objDateTime){
        //         $data[$objDateTime->format("n")][]=array(
        //             'day'=>$objDateTime->format("j"),
        //             'hour'=>$objDateTime->format("G"),
        //             'id_lesson'=>$les['id_lesson'],
        //             'data'=>$tmpArray
        //         );
        //     }
        //     $tmpArray=null;
        // }
        // var_dump($data);
        
        
    }
}