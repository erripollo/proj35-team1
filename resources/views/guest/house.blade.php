@extends('layouts.app')

@section('content')

    {{-- @php
    $lat1 = 45.1168763;
    $lon1 = 7.39455;

    $lat2 = 45.07022;
    $lon2 = 7.6842;

    $distance = (6371 * 3.1415926 * sqrt(($lat2 - $lat1) * ($lat2 - $lat1) + cos($lat2 / 57.29578) * cos($lat1 / 57.29578) * ($lon2 - $lon1) * ($lon2 - $lon1))) / 180;

    echo $distance;

    @endphp --}}

    <div class="container">

        <h3>Advanced Search</h3>
        <div class="row">
            <div class="col-6 pr-5">
                {{-- searchApart --}}
                <div class="form-group">
                    <label for="">Ricerca Città</label>
                    <input type="search" v-on:keyup="autocompleteAddress" v-model="location" class="form-control"
                        name="location" id="location" aria-describedby="helpId" placeholder=""
                        value="{{ $homeCitySearch }}">
                    <div v-show="showControl">
                        <ul v-for="item in autocomplete">
                            <li @click="searchHomePage(item)">@{{ item . address . municipality }},
                                @{{ item . address . countrySubdivision }}</li>
                        </ul>
                        {{-- <div class="list-group">
                            <a v-for="item in autocomplete" @click="searchHomePage(item)" href="#"
                                class="list-group-item list-group-item-action">@{{ item . address . municipality }},
                                @{{ item . address . countrySubdivision }}</a>
                        </div> --}}
                    </div>
                </div>

                <div class="form-group">
                    <label for="n_rooms">N. of rooms:</label>
                    <input type="number" name="n_rooms" id="n_rooms" class="form-control" placeholder="Add a n. of rooms"
                        aria-describedby="n_roomsHelper" v-model="rooms" min="0">
                </div>

                <div class="form-group">
                    <label for="n_beds">N. of beds:</label>
                    <input type="number" name="n_beds" id="n_beds" class="form-control" placeholder="Add a n. of beds"
                        aria-describedby="n_bedsHelper" v-model="searchBeds" min="0">
                </div>

                <form>
                    <div class="form-group">
                        <label for="formControlRange">Range Km @{{ range }}</label>
                        <input @click="newRange()" type="range" class="form-control-range" id="formControlRange" step="10"
                            max="100" v-model="range">
                    </div>
                </form>

                <button @click="searchHomePage(item)"> try</button>
            </div>
            <div class="col-6">
                <h5>Services</h5>
                <div class="d-flex flex-column flex-wrap" style="height: 250px">
                    <div class="form-check" v-for="service in services">
                        <label class="form-check-label">
                            <input v-on:change="checkFilter" v-on:check type="checkbox" class="form-check-input"
                                :name="service.name" :id="service.name" :value="service.name" v-model="serviceSelected">
                            @{{ service . name }}
                        </label>
                    </div>
                </div>

            </div>
        </div>

        {{-- Apart --}}
        {{-- @foreach ($apartments as $apartment)

            <div class="card text-left mb-4">

                <img class="card-img-top" src="holder.js/100px180/" alt="">
                <div class="card-body">
                    <h4 class="card-title">{{ $apartment->title }}</h4>
                    <p>City: {{ $apartment->address }}</p>
                    <img src=" {{ 'storage/' . $apartment->image }}" alt="{{ $apartment->title }}">
                    <p class="card-text">{{ $apartment->description }}</p>
                    <p>Rooms: {{ $apartment->n_rooms }}</p>
                    <p>Beds: {{ $apartment->n_beds }}</p>
                    <p>Service:</p>

                    @foreach ($apartment->services as $service)
                        <ul>
                            <li>{{ $service->name }}</li>
                        </ul>

                    @endforeach

                </div>
            </div>
        @endforeach --}}

        <div class="d-flex flex-wrap justify-content-center">


            {{-- <div class="card mb-3">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img width="100%" :src=" 'storage/' + apartment.image " :alt="apartment.title">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">@{{ apartment . title }}</h5>
                                <p class="card-text">@{{ apartment . description }}</p>
                                <p>Rooms: @{{ apartment . n_rooms }}</p>
                                <p>Beds: @{{ apartment . n_beds }}</p>
                                <p class="card-text" v-for="service in apartment.services"><small
                                        class="text-muted">@{{ service . name }}</small></p>
                                <a name="" id="" class="btn btn-primary" :href="'guest/apartment/' + apartment.id "
                                    role="button">Go to
                                    apartment</a>
                            </div>
                        </div>
                    </div>
                </div> --}}
            <div class="card text-left m-2" v-for="apartment in filteredApartments"
                v-if="apartment.n_rooms >= rooms && apartment.n_beds >= searchBeds" style="width: 350px">
                <img class="card-img-top" :src=" 'storage/' + apartment.image " :alt="apartment.title">
                <div class="card-body">
                    <h4 class="card-title">@{{ apartment . title }}</h4>
                    {{-- <img :src=" 'storage/' + apartment.image " :alt="apartment.title"> --}}
                    <p class="card-text">@{{ apartment . description }}</p>
                    <p>City: @{{ apartment . address }}</p>
                    <p>Rooms: @{{ apartment . n_rooms }}</p>
                    <p>Beds: @{{ apartment . n_beds }}</p>
                    <p class="card-text"><small class="text-muted"
                            v-for="service in apartment.services">@{{ service . name }} </small></p>
                </div>
                <a name="" id="" class="btn btn-primary" :href="'guest/apartment/' + apartment.id " role="button">Go to
                    apartment</a>
            </div>

        </div>

        {{-- <div v-if="temp.length > 0" v-for="apartment in temp">
            <div class="card text-left mb-4">
                <img class="card-img-top" src="holder.js/100px180/" alt="">
                <div class="card-body">
                    <h4 class="card-title">@{{ apartment . title }}</h4>
                    <p>City: @{{ apartment . address }}</p>
                    <img :src=" 'storage/' + apartment.image " :alt="apartment.title">
                    <p class="card-text">@{{ apartment . description }}</p>
                    <p>Rooms: @{{ apartment . n_rooms }}</p>
                    <p>Beds: @{{ apartment . n_beds }}</p>
                    <p>Service:</p>

                    <ul v-for="service in apartment.services">
                        <li>@{{ service . name }}</li>
                    </ul>
                </div>
            </div>
        </div> --}}
        {{-- <button v-on:click = 'searchApart'> try</button> --}}
    </div>



@endsection
