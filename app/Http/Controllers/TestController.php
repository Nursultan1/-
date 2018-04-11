<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    static function all(){
        echo "dcd";
    }
    function index(){
        $lists=Test::all();
        return view('test', compact('lists'));
    }
    function add(){
        return view('add');
    }
    function edit(){
        return view('add');
    }
    function save(Request $request){
        $Test= new Test;
        $Test->name=$request->input('name'); 
        $Test->last_name=$request->input('name');   
        $Test->save();
        return redirect('test');
    }
    function delete(){
        return redirect('test');
    }
}
