<?php

namespace App\Http\Controllers\Admin;

use App\Apartment;
use App\User;
use App\Sponsor;
use App\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::where('user_id', Auth::id())->get()->sortByDesc('id');

        return view('admin.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        $sponsors= Sponsor::all();
        return view('admin.apartments.create', compact('sponsors', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $validate = $request->validate([ 
            'title'=>'required | max:255 | min: 4',
            'address'=>'required | max:255 | min: 4',
            'latitude'=>'required',
            'longitude'=>'required',
            'image'=>'nullable | image | max: 500',
            'description'=>'nullable | min: 10',
            'n_rooms'=>'required | integer | min: 1',
            'n_baths'=>'required | integer | min: 1',
            'n_beds'=>'required | integer | min: 1',
            'square_meters'=>'nullable | integer | min:25',
            'visible'=>'required',
        ]);


        if ($request->hasFile('image')){
            $file_path = Storage::put('apart_img', $validate['image']);
            $validate['image'] = $file_path;
        }

        //dd($request->all());

        /* chiamata API e salvataggio della latitudine e longitudine in base all'indirizzo inserito */
        //$fullAddress = $request->city . ' ' . $request->address;
        //$response = Http::get('https://api.tomtom.com/search/2/geocode/' . $fullAddress . '.json?Key=WKV00hGlXHkJdGuro8v49W6Z2GpiQaqA')->json();
        //dd($response);
        //$lat = $response['results'][0]['position']['lat'];
        //$lon = $response['results'][0]['position']['lon'];
        //dd($lat, $lon);


        


        $apartment = Apartment::create($validate);
        $apartment->user_id = Auth::user()->id;
        //$apartment->latitude = $lat;
        //$apartment->longitude = $lon;
        //$apartment->fill($request->all());
        $apartment->save();
        
        
        
        $apartment->sponsors()->attach($request->sponsors);
        $apartment->services()->attach($request->services);
        return redirect()->route('admin.apartments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        if (Auth::user()->id == $apartment->user_id){
            $services = Service::all();
        if (Auth::user()) {
            $user = Auth::user()->email;
        }else{
            $user = '';
        }

            return view('admin.apartments.show', compact('apartment', 'user', 'services'));
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {   
        $services = Service::all();
        $sponsors= Sponsor::all();
        
        if (Auth::user()->id == $apartment->user_id){

            return view('admin.apartments.edit', compact('apartment','sponsors', 'services'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
        $validate = $request->validate([
            'title'=>'required | max:255 | min: 4',
            'address'=>'required | max:255 | min: 4',
            'latitude'=>'required',
            'longitude'=>'required',
            'image'=>'nullable | image | max: 150',
            'description'=>'nullable | min: 10',
            'n_rooms'=>'required | integer | min: 1',
            'n_baths'=>'required | integer | min: 1',
            'n_beds'=>'required | integer | min: 1',
            'square_meters'=>'nullable | integer | min:25',
            'visible'=>'required',
        ]);

        if (array_key_exists('image', $validate)){
            $file_path = Storage::put('apart_img', $validate['image']);
            $validate['image'] = $file_path;
            Storage::delete($apartment['image']);
        }

        /* chiamata API e salvataggio della latitudine e longitudine in base all'indirizzo inserito */
        //$fullAddress = $request->city . ' ' . $request->address;
        //$response = Http::get('https://api.tomtom.com/search/2/geocode/' . $fullAddress . '.json?Key=WKV00hGlXHkJdGuro8v49W6Z2GpiQaqA')->json();
        //dd($response);
        //$lat = $response['results'][0]['position']['lat'];
        //$lon = $response['results'][0]['position']['lon'];
        //dd($lat, $lon);

        //$apartment->latitude = $lat;
        //$apartment->longitude = $lon;
        


        $apartment->update($validate);
        $apartment->sponsors()->sync($request->sponsors);
        $apartment->services()->sync($request->services);
        return redirect()->route('admin.apartments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->services()->detach();
        $apartment->sponsors()->detach();
        $apartment->delete();
        Storage::delete($apartment['image']);
        return redirect()->route('admin.apartments.index');
    }
}
