@extends('layouts.app')

@section('content')

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
                <div class="divmessage d-flex flex-column col-6 mb-5">
                    <h2 class="mt-3 ">Contatta il propretario</h2>
                    <form action="{{ route('send.message', $apartment->id) }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="name">Nome:</label>
                            <input type="text" class="form-control" name="name" id="name" aria-describedby="nameHelper"
                                placeholder="Add your name">
                        </div>
                        <div class="form-group">
                            <label for="lastname">Cognome:</label>
                            <input type="text" class="form-control" name="lastname" id="lastname"
                                aria-describedby="lastnameHelper" placeholder="Add your lastname">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email w-20" class="form-control" name="email" id="email"
                                aria-describedby="emailHelper" placeholder="Add your email address"
                                value="{{ $user }}">
                        </div>
                        <div class="form-group">
                            <label for="body">Messaggio:</label>
                            <textarea class="form-control" name="body" id="body" rows="5"></textarea>
                        </div>

                        <button type="submit" class="btn formbutton">Invia <i class="fas fa-envelope"></i></button>
                    </form>
                </div>
                <div class="mt-5 col-6">
                    <div class="d-flex flex-column mt-4 divmap">
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
