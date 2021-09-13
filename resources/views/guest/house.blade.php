@extends('layouts.app')

@section('content')

    <div class="container">

        <h3>Ricerca avanzata</h3>
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
                    <label for="n_rooms">N. di stanze:</label>
                    <input type="number" name="n_rooms" id="n_rooms" class="form-control" placeholder="Add a n. of rooms"
                        aria-describedby="n_roomsHelper" v-model="rooms" min="0">
                </div>

                <div class="form-group">
                    <label for="n_beds">N. di letti:</label>
                    <input type="number" name="n_beds" id="n_beds" class="form-control" placeholder="Add a n. of beds"
                        aria-describedby="n_bedsHelper" v-model="searchBeds" min="0">
                </div>

                <form>
                    <div class="form-group">
                        <label for="formControlRange">Distanza Km @{{ range }}</label>
                        <input @click="newRange()" type="range" class="form-control-range" id="formControlRange" step="10"
                            max="100" v-model="range">
                    </div>
                </form>
            </div>
            <div class="col-6">
                <h5>Servizi</h5>
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

        <div class="d-flex flex-wrap justify-content-center mt-5">


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
            <div class="card text-left m-2 shadow" v-for="apartment in filteredApartments"
                v-if="apartment.n_rooms >= rooms && apartment.n_beds >= searchBeds" style="width: 350px">
                <img height="230px" width="100%" class="card-img-top" :src=" 'storage/' + apartment.image "
                    :alt="apartment.title">
                <div class="card-body">
                    <h4 class="card-title">@{{ apartment . title }}</h4>
                    {{-- <img :src=" 'storage/' + apartment.image " :alt="apartment.title"> --}}
                    <p class="card-text">@{{ apartment . description }}</p>
                    <p><i class="fas fa-map-marker-alt"></i> @{{ apartment . address }}</p>
                    <p><i class="fas fa-door-open"></i> @{{ apartment . n_rooms }} stanze</p>
                    <p><i class="fas fa-bed"></i> @{{ apartment . n_beds }}</p>
                    <p class="card-text"><small class="text-muted m-2"
                            v-for="service in apartment.services">@{{ service . name }} </small></p>
                </div>
                <a name="" id="" class="btn btn-outline-info my-3 mx-5" :href="'guest/apartment/' + apartment.id "
                    role="button"><i class="fas fa-home"></i> Visita
                    l'appartamento</a>
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
