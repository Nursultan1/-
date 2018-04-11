<?php

namespace App\Http\Controllers;

use App\Classe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class ClassController extends Controller
{
    function index(){
        $name="test";
        return view('index', compact('name'));
    }
    function add(){

    }
    
}
