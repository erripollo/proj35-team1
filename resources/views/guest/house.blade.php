@extends('layouts.app')

@section('content')

    <div class="container">

        <h3 class="mt-5">Soggiorni nell'area indicata</h3>
        <div class="row d-flex align-items-center selection">
            <div class="col-6 pr-5 d-flex justify-content-around align-items-center">
                {{-- searchApart --}}
                <div class="form-group position-relative">
                    <label for="">Città</label>
                    <input type="search" v-on:keyup="autocompleteAddress" v-model="location" class="form-control"
                        name="location" id="location" aria-describedby="helpId" placeholder=""
                        value="{{ $homeCitySearch }}">
                    <div class="dropdown_menu" v-show="showControl">
                        <ul>
                            <li v-for="item in autocomplete" @click="searchHomePage(item)">
                                @{{ item . address . municipality }},
                                @{{ item . address . countrySubdivision }}</li>
                        </ul>
                        {{-- <div class="list-group">
                            <a v-for="item in autocomplete" @click="searchHomePage(item)" href="#"
                                class="list-group-item list-group-item-action">@{{ item . address . municipality }},
                                @{{ item . address . countrySubdivision }}</a>
                        </div> --}}
                    </div>
                </div>
                <form>
                    <div class="form-group">
                        <label for="formControlRange">Distanza Km @{{ range }}</label>
                        <input @click="newRange()" type="range" class="form-control-range" id="formControlRange" step="10"
                            max="100" v-model="range">
                    </div>
                </form>
            </div>
            <div class="col-6 d-flex justify-content-around align-items-center">
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Servizi
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <div class="services">
                            <div class="form-check" v-for="service in services">
                                <label class="form-check-label">
                                    <input v-on:change="checkFilter" v-on:check type="checkbox" class="form-check-input"
                                        :name="service.name" :id="service.name" :value="service.name"
                                        v-model="serviceSelected">
                                    @{{ service . name }}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Stanze e letti
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <div class="numbers">
                            <div class="form-group">
                                <input type="number" name="n_rooms" id="n_rooms" class="form-control"
                                    placeholder="Numero Stanze" aria-describedby="n_roomsHelper" v-model="rooms" min="0">
                            </div>
                            <div class="form-group">
                                <input type="number" name="n_beds" id="n_beds" class="form-control"
                                    placeholder="Numero Letti" aria-describedby="n_bedsHelper" v-model="searchBeds" min="0">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="found">
            <div class="card text-left m-5 shadow" v-for="apartment in filteredApartments"
                v-if="apartment.n_rooms >= rooms && apartment.n_beds >= searchBeds">
                <div class="row">
                    <div class="col-6">
                        <img class="card-img-top" :src=" 'storage/' + apartment.image " :alt="apartment.title">
                    </div>
                    <div class="col-6">
                        <div class="card-body">
                            <h4 class="card-title">@{{ apartment . title }}</h4>
                            {{-- <img :src=" 'storage/' + apartment.image " :alt="apartment.title"> --}}
                            <p class="card-text">@{{ apartment . description }}</p>
                            <p><i class="fas fa-map-marker-alt"></i> @{{ apartment . address }}</p>
                            <p><i class="fas fa-door-open"></i> @{{ apartment . n_rooms }} stanze</p>
                            <p><i class="fas fa-bed"></i> @{{ apartment . n_beds }}</p>
                            <p id="" class="card-text"><small class="m-2"
                                    v-for="service in apartment.services">@{{ service . name }} </small></p>

                        </div>
                    </div>
                </div>
                <a name="" id="" class="btn btn-outline-info my-3 mx-5" :href="'guest/apartment/' + apartment.id "
                    role="button"><i class="fas fa-home"></i> Visita
                    l'appartamento</a>
            </div>

        </div>

    </div>



@endsection
