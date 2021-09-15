@extends('layouts.app')

@section('content')
    {{-- section search --}}
    <section class='search_section d-flex align-content-center'>
        <div class="container-fluid d-flex">

            <div
                class='d-flex flex-column col-10 col-md-7 col-lg-6 col-xl-5 offset-1 align-content-center justify-content-center'>
                <h1 class="mb-4">Ogni alloggio è una destinazione </h1>
                <form action="{{ route('house') }}" method="get">
                    @csrf
                    <div class="d-flex align-items-start col-12 p-0">
                        <div class="form-group col-10 p-0 mr-2">
                            <div>
                                <input type="text" v-on:keyup="autocompleteAddress" v-model="location"
                                    class="form-control mr-2 input_searchbar" name="location" id="location"
                                    aria-describedby="helpId" placeholder="Search City">
                                <div v-show="showControl">
                                    <div class="list-group">
                                        <a v-for="item in autocomplete" @click="searchHomePage(item)" href="#"
                                            class="list-group-item list-group-item-action">@{{ item . address . municipality }},
                                            @{{ item . address . countrySubdivision }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a v-on:click="persist" name="search" id="search" class="btn button_search"
                            :class="(location) ? 'active' : 'disabled' " href="{{ route('house') }}"
                            role="button">Search</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
    {{-- section search --}}

    {{-- section sponsorapart --}}
    <section class="sponsored_section">
        <div class="sponsored_apartment pt-5 d-flex flex-wrap">
            <h3 class="col-11 offset-1 p-0">Appartamenti in evidenza</h3>
            {{-- Qui ci va il foreach --}}

            <div class="container_cards d-flex justify-content-around flex-wrap">
                @foreach ($sponsoredApartment as $apartment)
                    <div class="card_apartment d-flex flex-column align-self-center justify-content-center my-4">
                        <div class="image_apartment">
                            <i class="fas fa-star"></i>
                            <img class='image_apart mb-2' src="{{ asset('storage/' . $apartment->image) }}" alt="">
                        </div>
                        <div class="titolo col-12 mb-2">
                            <h5>{{ $apartment->title }}</h5>
                        </div>
                        <div class="descrizione_apartment col-12 my-2">
                            {{ $apartment->description }}
                        </div>
                        {{-- <div class="servizi_appartamento col-12">
                            <h5>Servizi:</h5>
                            
                            <ul class="col-12 d-flex flex-column flex-wrap">
                                @foreach ($apartment->services as $service)
                                    <li class="col-6">{{ $service->name }}</li>
                                @endforeach
                            </ul>
                            
                        </div> --}}
                        <div class="button_show_apartment col-12 d-flex justify-content-center">
                            <a href="{{ route('guest.apartment.show', $apartment->id) }}" class="bottone_visualizza">Vedi
                                aloggio</a>
                        </div>
                    </div>
                @endforeach

            </div>


            {{-- Qui ci va il foreach --}}

        </div>

    </section>
    {{-- section sponsorapart --}}
    <section></section>

@endsection
