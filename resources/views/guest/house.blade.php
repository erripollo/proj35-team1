@extends('layouts.app')

@section('content')

    {{-- @php
    $lat1=45.1168763;
    $lon1=7.39455;

    $lat2=45.070220;
    $lon2=7.684200;

    $distance = (6371*3.1415926*sqrt(($lat2-$lat1)*($lat2-$lat1) + cos($lat2/57.29578)*cos($lat1/57.29578)*($lon2-$lon1)*($lon2-$lon1))/180);

    echo $distance;
        
    @endphp --}}

    <div class="container-xl">

        <div class="col-5">
            {{-- searchApart --}}
            <div class="form-group">
                <label for="">Ricerca Città</label>
                <input type="search" class="form-control" name="" id="" aria-describedby="helpId" placeholder="" v-model='searchCity' >
            </div>
            
            <div class="form-group">
                <label for="n_rooms">N. of rooms:</label>
                <input type="number" name="n_rooms" id="n_rooms" class="form-control" placeholder="Add a n. of rooms" aria-describedby="n_roomsHelper" v-model="searchRooms" min="0">
            </div>

            <div class="form-group">
                <label for="n_beds">N. of beds:</label>
                <input type="number" name="n_beds" id="n_beds" class="form-control" placeholder="Add a n. of beds" aria-describedby="n_bedsHelper" v-model="searchBeds" min="0">
            </div>

            <form>
                <div class="form-group">
                  <label for="formControlRange">Range Km @{{range}}</label>
                  <input type="range" class="form-control-range" id="formControlRange" step="10" max="100" v-model="range">
                </div>
            </form>

            <div class="form-check" v-for="service in services" v-model="serviceSelected">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" :name="service.name" :id="service.name" :value="service.name" v-model="serviceSelected">
                @{{ service.name }}
              </label>
            </div>
    
            <button v-on:click ='searchApart'> try</button>
        </div>

        {{-- Apart --}}
        <div class="card text-left mb-4" v-for="apartment in apartments"
        v-if='apartment.city.toLowerCase().includes(searchCity.toLowerCase()) && searchCity.length > 0 && apartment.n_rooms >= searchRooms && apartment.n_beds >= searchBeds'>

            <img class="card-img-top" src="holder.js/100px180/" alt="">
            <div class="card-body">
                <h4 class="card-title">@{{ apartment.title }}</h4>
                <p>City: @{{ apartment.city }}</p>
                <img :src=" 'storage/' + apartment.image " :alt="apartment.titles">
                <p class="card-text">@{{ apartment.description }}</p>
                <p>Rooms: @{{ apartment.n_rooms }}</p>
                <p>Beds: @{{ apartment.n_beds }}</p>
                <p>Service:</p>
                <ul v-for="service in apartment.services">
                    <li>@{{ service.name }}</li>
                </ul>

            </div>
        </div>


        {{-- <button v-on:click = 'searchApart'> try</button> --}}
    </div>



@endsection
