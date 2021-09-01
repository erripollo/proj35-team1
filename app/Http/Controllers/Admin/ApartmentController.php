<?php

namespace App\Http\Controllers\Admin;

use App\Apartment;
use App\User;
use App\Sponsor;
use App\Service;
use Illuminate\Support\Facades\Auth;
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
        $apartments = Apartment::all();

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
            'city'=>'required | max:50 | min: 2',
            'address'=>'required | max:255 | min: 4',
            'latitude'=>'required',
            'longitude'=>'required',
            'image'=>'nullable | image | max: 150',
            'description'=>'nullable | min: 10',
            'n_rooms'=>'required | integer | min: 1',
            'n_baths'=>'required | integer | min: 1',
            'n_beds'=>'required | integer | min: 1',
            'squared_meters'=>'nullable | integer | min:25',
            'visible'=>'required',
        ]);

       $apartment = new Apartment();
       
       $apartment-> user_id = Auth::user()->id;
       $apartment->fill($request->all());
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
        return view('admin.apartments.show', compact('apartment'));
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
        return view('admin.apartments.edit', compact('apartment','sponsors', 'services'));
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
            'city'=>'required | max:50 | min: 2',
            'address'=>'required | max:255 | min: 4',
            'latitude'=>'required',
            'longitude'=>'required',
            'image'=>'nullable | image | max: 150',
            'description'=>'nullable | min: 10',
            'n_rooms'=>'required | integer | min: 1',
            'n_baths'=>'required | integer | min: 1',
            'n_beds'=>'required | integer | min: 1',
            'squared_meters'=>'nullable | integer | min:25',
            'visible'=>'required',
            
        
        ]);
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
        $apartment->delete();
        $apartment->sponsors()->detach();
        return redirect()->route('admin.apartaments.index');
    }
}
