@extends('layouts.admin')

@section('content')

    <h1 class="text-center pt-3 pb-3 mb-4">AGGIUNGI UN NUOVO APPARTAMENTO</h1>

    <div class="container">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.apartments.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">TITOLO:</label>
                <input type="text" name="title" id="title" class="form-control border border-primary mb-4 @error('title') is-invalid @enderror"
                aria-describedby="titleHelper" value="{{ old('title') }}" required>
            </div>
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="address">INDIRIZZO:</label>
                <input v-on:keyup="autocompleteAddress" v-model="location" type="text" name="address" id="address"
                    class="form-control border border-primary mb-4 @error('address') is-invalid @enderror"
                    aria-describedby="addressHelper" value="{{ old('address') }}" required>
                <div v-show="showControl" style="background-color: white;">
                    <ul v-for="item in autocomplete" style="list-style: none; padding: 0 10px;">
                        <li @click="luogo(item)">@{{ item . address . municipality }},
                            @{{ item . address . countrySubdivision }},
                            @{{ item . address . streetName }}, @{{ item . address . streetNumber }}</li>
                    </ul>
                </div>
            </div>
            @error('address')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group d-none">
                <label for="latitude">LATITUDINE:</label>
                <input v-model="latitudine" type="number" step="0.000001" name="latitude" id="latitude"
                    class="form-control @error('latitude') is-invalid @enderror" placeholder="Add a latitude"
                    aria-describedby="latitudeHelper" value="{{ old('latitude') }}" required>
            </div>
            @error('latitude')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group d-none">
                <label for="longitude">LONGITUDINE:</label>
                <input v-model="longitudine" type="number" step="0.000001" name="longitude" id="longitude"
                    class="form-control @error('longitude') is-invalid @enderror" placeholder="Add a longitude"
                    aria-describedby="longitudeHelper" value="{{ old('longitude') }}" required>
            </div>
            @error('longitude')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="image">IMMAGINE:</label>
                <input type="file" class="form-control-file mb-4" name="image" id="image"
                    aria-describedby="imageHelper">
            </div>
            @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror


            <div class="form-group">
                <label for="description">DESCRIZIONE:</label>
                <textarea name="description" id="description"
                    class="form-control text-muted border border-primary mb-4 @error('description') is-invalid @enderror" rows="5">
                    {{ old('description') }}</textarea>
            </div>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="n_rooms">STANZE:</label>
                <input type="number" name="n_rooms" id="n_rooms" class="form-control border border-primary mb-4 @error('n_rooms') is-invalid @enderror"
                aria-describedby="n_roomsHelper" value="{{ old('n_rooms') }}" required>
            </div>
            @error('n_rooms')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="n_baths">BAGNI:</label>
                <input type="number" name="n_baths" id="n_baths" class="form-control border border-primary mb-4 @error('n_baths') is-invalid @enderror"
                 aria-describedby="n_bathsHelper" value="{{ old('n_baths') }}" required>
            </div>
            @error('n_baths')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="n_beds">LETTI:</label>
                <input type="number" name="n_beds" id="n_beds" class="form-control border border-primary mb-4 @error('n_beds') is-invalid @enderror"
                aria-describedby="n_bedsHelper" value="{{ old('n_beds') }}" required>
            </div>
            @error('n_beds')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="square_meters">METRI QUADRATI:</label>
                <input type="number" name="square_meters" id="square_meters"
                    class="form-control border border-primary mb-4 @error('square_meters') is-invalid @enderror"
                    aria-describedby="square_metersHelper" value="{{ old('square_meters') }}" required>
            </div>
            @error('square_meters')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="services">SERVIZI</label>
                <select multiple class="form-control border border-primary mb-5" name="services[]" id="services">
                    <option value="" class="text-primary" disabled>Select a service</option>
                    @if ($services)
                        @foreach ($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            @error('services')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <fieldset class="form-group row">
                <legend class="col-form-label col-sm-2 float-sm-left pt-0 mb-3">VUOI PUBBLICARLO?:</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="visible" id="visible" value="1">
                        <label class="form-check-label" for="visible">
                            SI
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="visible" id="visible" value="0">
                        <label class="form-check-label" for="visible">
                            NO
                        </label>
                    </div>
                </div>
            </fieldset>

            @error('visible')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-primary mr-3">CREA</button>
            <button class="btn btn-danger"><a class="text-white text-decoration-none"
                    href="{{ route('admin.apartments.index') }}">CANCELLA</a></button>
        </form>
    </div>


@endsection
