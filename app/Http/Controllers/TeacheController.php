<?php

namespace App\Http\Controllers;

use DB;
use App\Classe;
use App\User;
use App\Teache;
use Artisan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeacheController extends Controller
{
    function show(){
        $teaches=DB::select('select * from teaches');
        // dd($teaches);
        return view('admin/teache', compact('teaches'));
    }
    function delete($id){
        DB::delete("delete from teaches where id_teache=$id");
        return redirect('admin/teache');
    }
    function ajaxRead(){
        $res = array('error' => false);
        $teaches=DB::select("select * from teaches where config='1'");
        $arrayTeache=array();
        foreach($teaches as $teache){
            $arrayTeache[]=array(
                'id_teache'=>$teache->id_teache,
                'fio_teache'=>$teache->fio_teache,
                'email'=>$teache->email,
                'name_class'=>$teache->name_class,
            );
        }
        $res['teaches']=$arrayTeache;
        header("Content-type: application/json");
        echo json_encode($res);
    }

    function ajaxReadRequest(){
        $res = array('error' => false);
        $requests=DB::select("select * from teaches where config='0'");
        $arrayRequest=array();
        foreach($requests as $request){
            $arrayRequest[]=array(
                'id_teache'=>$request->id_teache,
                'fio_teache'=>$request->fio_teache,
                'email'=>$request->email,
            );
        }
        $res['requests']=$arrayRequest;
        header("Content-type: application/json");
        echo json_encode($res);
    }

    function ajaxRequestConfig(Request $request){
        $res = array(
            'error' => false,
            'message'=>''
        );
        $id_teache=$request->input('id_teache');
        DB::update("update teaches set config ='1' where id_teache = '$id_teache'");
        header("Content-type: application/json");
        echo json_encode($res);
    }

    function ajaxUpdate(Request $request){
        $res = array(
            'error' => false,
            'message'=>''
        );
        $email=$request->input('email');
        $id_teache=$request->input('id_teache');
        $fio_teache=$request->input('fio_teache');
        DB::update("update teaches set fio_teache ='$fio_teache', email='$email'  where id_teache = '$id_teache'");
        header("Content-type: application/json");
        echo json_encode($res);
    }
    function ajaxDelete(Request $request){
        $res = array(
            'error' => false,
            'message'=>''
        );
        $id_teache=$request->input('id_teache');
        $tmp=DB::table('classes')->where('id_teache', "$id_teache")->value('id_teache');
        if(isset($tmp)){
            $res['error']=true;
            $res['message']="Невозможно удалить этого преподователя";
        }
        else{
            DB::delete("delete from teaches where id_teache='$id_teache'");
            $res['message']="Преподователь удален из базы данных";            
        }
        header("Content-type: application/json");
        echo json_encode($res);
    }

    // home

    function ajaxUpdatePassword(Request $request){
        $res = array(
            'error' => false,
            'message'=>''
        );
        $current=bcrypt($request->input('current'));
        $new=bcrypt($request->input('new'));
        $new2=bcrypt($request->input('new2'));
        // $teaches=DB::select("select  * fron teaches  where password='$current'");
        DB::update("update teaches set password='$new' where password='$current' ");
        // if(!empty($teaches)){
        //     $id_teache=$teaches[0]->id_teache;
        //     DB::update("update teaches set password='$new' where id_teache='$id_teache' ");
        // }
        header("Content-type: application/json");
        echo json_encode($res);
    }
}