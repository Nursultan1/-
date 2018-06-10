<?php

namespace App\Http\Controllers;
use DB;
use App\Classe;
use App\User;
use App\Teache;
use Artisan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PupilController extends Controller
{
    function pupils($id){
        $class=Classe::find($id);
        $className=$class->class_name_numbe."_".$class->class_name_categori;
        return view('admin/pupil',compact('className'));
    }
    function save(Request $request){
        $fio=$request->input('fio');
        $idClass=$request->input('idClass');
        $idPupil=$request->input('idPupil');
        $class=Classe::find($idClass);
        if($idPupil!=""){
            echo $idPupil;
        }
        else{
            DB::insert("insert into class".$class->class_name_numbe."_".$class->class_name_categori."_pupils (fio_pupil) values ('$fio')");
        }
        return redirect("admin/pupils/$idClass");
    }

    function ajaxRead($className){
        $res = array(
            'error' => false,
            'message'=>''
        );
        $pupils = DB::select("select * from class".$className."_pupils order by fio_pupil");
        $tmp=array();
        foreach($pupils as $pupil){
            $tmp[]=array(
                'id_pupil'=>$pupil->id_pupil,
                'fio_pupil'=>$pupil->fio_pupil
            );
        }
        $res['pupils']=$tmp;
        header("Content-type: application/json");
        echo json_encode($res);
    }


    function ajaxSave(Request $request,$className){
        $res = array(
            'error' => false,
            'message'=>''
        );
        $fio_pupil=$request->input('fio_pupil');
        DB::table("class".$className."_pupils")->insert(
            ['fio_pupil' => "$fio_pupil"]
        );
        header("Content-type: application/json");
        echo json_encode($res);
    }


    function ajaxUpdate(Request $request,$className){
        $res = array(
            'error' => false,
            'message'=>''
        );
        $id_pupil=$request->input('id_pupil');
        $fio_pupil=$request->input('fio_pupil');

        DB::table("class".$className."_pupils")
            ->where('id_pupil', $id_pupil)
            ->update(['fio_pupil' => $fio_pupil]);

        header("Content-type: application/json");
        echo json_encode($res);
    }


    function ajaxDelete(Request $request,$className){
        $res = array(
            'error' => false,
            'message'=>''
        );
        $id_pupil=$request->input('id_pupil');
        $fio_pupil=$request->input('fio_pupil');

        DB::table("class".$className."_pupils")
            ->where('id_pupil', $id_pupil)
            ->delete();

        header("Content-type: application/json");
        echo json_encode($res);
    }
}
