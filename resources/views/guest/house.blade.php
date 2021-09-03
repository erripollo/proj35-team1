@extends('layouts.app')

@section('content')

    <div class="container-xl">
        {{-- searchApart --}}
        <div class="form-group col-5">
            <label for="">Ricerca Città</label>
            <input type="search" class="form-control" name="" id="" aria-describedby="helpId" placeholder="" v-model='searchCity' >
        </div>


        {{-- Apart --}}


        <div class="card text-left" v-for="apartment in apartments" v-if='apartment.city.toLowerCase().includes(searchCity.toLowerCase()) && searchCity.length > 0'>
            <img class="card-img-top" src="holder.js/100px180/" alt="">
            <div class="card-body">
                <h4 class="card-title">@{{ apartment.title }}</h4>
                <p class="card-text">@{{ apartment.description }}</p>
            </div>
        </div>


        <button v-on:click = 'searchApart'> try</button>
    </div>



@endsection
