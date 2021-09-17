@extends('layouts.admin')

@section('content')

    <h1 class="text-center pt-3 pb-3">MODIFICA APPARTAMENTO</h1>

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

        <form action="{{ route('admin.apartments.update', $apartment->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="title">MODIFICA TITOLO:</label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                    placeholder="Add a title" aria-describedby="titleHelper" value="{{ $apartment->title }}" required>
            </div>
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="address">MODIFICA INDIRIZZO:</label>
                <input v-on:keyup="autocompleteAddress" type="text" name="address" id="address"
                    class="form-control @error('address') is-invalid @enderror" placeholder="Add a address"
                    aria-describedby="addressHelper" value="{{ $apartment->address }}" v-model="location" required>
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

            {{-- <div class="form-group">
            <label for="address">EDIT ADDRESS:</label>
            <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="Add a address" aria-describedby="addressHelper" value="{{$apartment->address}}" required>
        </div>
        @error('address')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror --}}

            <div class="form-group d-none">
                <label for="latitude">EDIT LATITUDE:</label>
                <input v-model="latitudine" type="number" step="0.000001" name="latitude" id="latitude"
                    class="form-control @error('latitude') is-invalid @enderror" placeholder="Add a latitude"
                    aria-describedby="latitudeHelper" value="{{ $apartment->latitude }}" required>
            </div>
            @error('latitude')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group d-none">
                <label for="longitude">EDIT LONGITUDE:</label>
                <input v-model="longitudine" type="number" step="0.000001" name="longitude" id="longitude"
                    class="form-control @error('longitude') is-invalid @enderror" placeholder="Add a longitude"
                    aria-describedby="longitudeHelper" value="{{ $apartment->longitude }}" required>
            </div>
            @error('longitude')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            {{-- current image --}}
            <div class="form-group">
                <h4>Current image</h4>
                <img width="150" src="{{ asset('storage/' . $apartment->image) }}" alt="{{ $apartment->title }}">
            </div>

            {{-- load image --}}
            <div class="form-group">
                <label for="image">CAMBIA IMMAGINE</label>
                <input type="file" name="image" id="image" class="form-control-file"
                    placeholder="Change the apartment image" aria-describedby="imageHelper" @error('image') is-invalid
                    @enderror>
                <small id="imageHelper" class="text-muted">Change the image for this apartment</small>
            </div>
            {{-- error image --}}
            @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="description">MODIFICA DESCRIZIONE:</label>
                <textarea name="description" id="description"
                    class="form-control text-muted @error('description') is-invalid @enderror" rows="5"
                    placeholder="Add a description">{{ $apartment->description }}</textarea>
            </div>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="n_rooms">MODIFICA STANZE:</label>
                <input type="number" name="n_rooms" id="n_rooms" class="form-control @error('n_rooms') is-invalid @enderror"
                    placeholder="Add a n_rooms" aria-describedby="n_roomsHelper" value="{{ $apartment->n_rooms }}"
                    required>
            </div>
            @error('n_rooms')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="n_baths">MODIFICA BAGNI:</label>
                <input type="number" name="n_baths" id="n_baths" class="form-control @error('n_baths') is-invalid @enderror"
                    placeholder="Add a n_baths" aria-describedby="n_bathsHelper" value="{{ $apartment->n_baths }}"
                    required>
            </div>
            @error('n_baths')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="n_beds">MODIFICA LETTI:</label>
                <input type="number" name="n_beds" id="n_beds" class="form-control @error('n_beds') is-invalid @enderror"
                    placeholder="Add a n_beds" aria-describedby="n_bedsHelper" value="{{ $apartment->n_beds }}" required>
            </div>
            @error('n_beds')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="square_meters">MODIFICA METRI QUADRI:</label>
                <input type="number" name="square_meters" id="square_meters"
                    class="form-control @error('square_meters') is-invalid @enderror" placeholder="Add a square_meters"
                    aria-describedby="square_metersHelper" value="{{ $apartment->square_meters }}" required>
            </div>
            @error('square_meters')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="services">MODIFICA SERVIZI:</label>
                <select multiple class="form-control" name="services[]" id="services">
                    <option value="" disabled>Select a service</option>
                    @if ($services)
                        @foreach ($services as $service)
                            @if ($errors->any())
                                <option value="{{ $service->id }}"
                                    {{ in_array($service->id, old('services')) ? 'selected' : '' }}>
                                    {{ $service->name }}</option>
                            @else
                                <option value="{{ $service->id }}"
                                    {{ $apartment->services->contains($service) ? 'selected' : '' }}>
                                    {{ $service->name }}</option>
                            @endif
                        @endforeach
                    @endif
                </select>
            </div>

            <fieldset class="form-group row">
                <legend class="col-form-label col-sm-2 float-sm-left pt-0">VUOI PUBBLICARLO?:</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="visible" id="visible" value="1"
                            {{ $apartment->visible ? 'checked' : '' }}>
                        <label class="form-check-label" for="visible">
                            SI
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="visible" id="visible" value="0"
                            {{ $apartment->visible ? '' : 'checked' }}>
                        <label class="form-check-label" for="visible">
                            NO
                        </label>
                    </div>
                </div>
            </fieldset>

            @error('visible')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn btn-primary">EDIT</button>
        </form>
    </div>


@endsection
