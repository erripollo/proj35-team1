@extends('layouts.app')

@section('content')

    {{-- <div class="container">
    <div class="row">
            <div class="col-md-4">
                <div class="card text-left m-3" style="min-height: 800px;">
                    <img class="card-img-top" src="{{ asset('storage/' . $apartment->image) }}" alt="">
                    <div class="card-body">
                        <h2 class="card-title">{{ $apartment->title }}</h2>
                        <h4 class="card-title">{{ $apartment->address }}</h4>
                        <p class="card-text">{{ $apartment->description }}</p>
                        <span>{{ $apartment->visible }}</span>
                    </div>
                </div>
            </div>
        </div>
        
</div> --}}
    <div class="container">
        @if (session('message'))
            <div class="alert alert-success" role="alert">

                <strong>{{ session('message') }}</strong>

            </div>
        @endif
        <div class="topdiv">
            <h2 class="hometitle">{{ $apartment->title }}</h2>
            <h4 class="homeaddress">{{ $apartment->address }}</h4>
        </div>
        <div class="col-12 imgdiv">
            <img class="img-fluid" src="{{ asset('storage/' . $apartment->image) }}" alt=""
                style="object-fit: cover;">
        </div>
        <div class="d-flex flex-row mt-5">
            <div class="d-flex flex-column col-6 homedesc">
                <h4>DESCRIZIONE</h4>
                <p class="card-text">{{ $apartment->description }}</p>
            </div>
            <div class="d-flex flex-column col-6 homeservice">
                <h4>SERVIZI</h4>
                <div class="divservice">
                    @foreach ($apartment->services as $service)
                        <ul>
                            <li><i class="fas fa-star"></i> {{ $service->name }}</li>
                        </ul>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="mt-5 col-10 offset-1 mb-5">
                    <div class="d-flex flex-column align-items-center mt-4 divmap">
                        <div class="divbutton"><button class="buttonmap"
                                v-on:click="showMap({{ $apartment->latitude }}, {{ $apartment->longitude }})">MOSTRA
                                MAPPA <i class="fas fa-map-marker-alt"></i></button></div>
                        <div id="map" class="map mt-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    </div>

    {{-- <div class="container">
        <button v-on:click="showMap({{ $apartment->latitude }}, {{ $apartment->longitude }})">Show Map</button>
        <div id="map" class="map mt-3"></div>
    </div> --}}
    </div>

@endsection
