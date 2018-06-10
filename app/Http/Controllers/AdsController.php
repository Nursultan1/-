<?php

namespace App\Http\Controllers;

use DB;
use App\Classe;
use App\Ads;
use App\User;
use App\Teache;
use Artisan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DateTime;
use DateInterval;

class AdsController extends Controller
{
    function read(){
        $adses=Ads::all();
        // dd($adses);
        return view('admin/ads', compact('adses'));
    }
    function update($id=null){
        if($id!=null){
            $adses=Ads::where('id_ads', $id)->get();
            //dd($adses);
            return view('admin/ads-update', compact('adses'));
        }
        return view('admin/ads-update');
    }
    function save(Request $request, $id=null){
        $date =new DateTime();
        if($id===null){
            $ads = new Ads;
            $ads->title = $request->title;
            $ads->text = $request->text;
            $ads->date = $date->format("Y-m-d");
            $ads->save();
        }
        else{
            $ads = Ads::find($id);
            $ads->title = $request->title;
            $ads->text = $request->text;
            $ads->date = $date->format("Y-m-d");
            $ads->save();
        }
        return redirect('admin/ads');
    }
    function create(){
        return view('admin/ads-create');
    }
    function delete($id_ads){
        $ads = Ads::find($id_ads);
        $ads->delete();
        return redirect('admin/ads');
    }


    function readU(){
        $adses=Ads::all();
        // dd($adses);
        return view('ads', compact('adses'));
    }

}
