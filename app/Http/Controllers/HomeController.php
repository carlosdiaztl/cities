<?php

namespace App\Http\Controllers;

use App\Http\Requests\CityRequest;
use App\Http\Requests\ProductRequest;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $apikey = env('CSC_API_KEY1');
        $countries = Http::withHeaders([
            'X-CSCAPI-KEY' => "$apikey"
        ])->get('https://api.countrystatecity.in/v1/countries')->json();

        return view('home',compact('countries'));
    }

    public function states($request)
    {
        $apikey = env('CSC_API_KEY1');
        $states = Http::withHeaders([
            'X-CSCAPI-KEY' => "$apikey"
        ])->get("https://api.countrystatecity.in/v1/countries/".$request."/states")->json();

        return $states;
    }

    public function cities($country,$state)
    {
        $apikey = env('CSC_API_KEY1');
        $cities = Http::withHeaders([
            'X-CSCAPI-KEY' => "$apikey"
        ])->get("https://api.countrystatecity.in/v1/countries/".$country."/states/".$state."/cities")->json();

        return $cities;
    }
    public function city($request)
    {
        $apiKey = env('CSC_API_KEY');
        $cities = Http::withHeaders([
            'X-Api-Key' => "$apiKey"
        ])->get("https://api.api-ninjas.com/v1/city?name=$request")->json();

        return $cities;
    }
    public function store(CityRequest $request,)
    {
        $city = new City($request->validated());
        $city->save();
        if(auth()->user()->cities()->count() >=5){
            return redirect()->back()->withErrors('El Maximo de ciudades por usuario es de 5 usuario');
        }
        auth()->user()->cities()->attach($city);
        return redirect()->back()->withSuccess('Ciudad Guardada con exito');
    }
}
