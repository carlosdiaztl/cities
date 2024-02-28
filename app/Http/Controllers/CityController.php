<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(){
        $cities = auth()->user()->cities;
        return view('city.index',compact('cities'));
    }
    public function destroy($city){
        auth()->user()->cities()->detach($city);
        return redirect()->back()->with('success','Ciudad eliminada successfully');
    }
    //
}
