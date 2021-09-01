@extends('layouts.admin')

@section('content')

<h1 class="text-center pt-3 pb-3">CHANGE THE APARTMENT</h1>

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
            <label for="title">EDIT TITLE:</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Add a title" aria-describedby="titleHelper" value="{{$apartment->title}}" required>
        </div>
        @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="city">EDIT CITY:</label>
            <input type="text" name="city" id="city" class="form-control @error('city') is-invalid @enderror" placeholder="Add a city" aria-describedby="cityHelper" value="{{$apartment->city}}" required>
        </div>
        @error('city')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="address">EDIT ADDRESS:</label>
            <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="Add a address" aria-describedby="addressHelper" value="{{$apartment->address}}" required>
        </div>
        @error('address')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="latitude">EDIT LATITUDE:</label>
            <input type="number" step="0.000001" name="latitude" id="latitude" class="form-control @error('latitude') is-invalid @enderror" placeholder="Add a latitude" aria-describedby="latitudeHelper" value="{{$apartment->latitude}}" required>
        </div>
        @error('latitude')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="longitude">EDIT LONGITUDE:</label>
            <input type="number" step="0.000001" name="longitude" id="longitude" class="form-control @error('longitude') is-invalid @enderror" placeholder="Add a longitude" aria-describedby="longitudeHelper" value="{{$apartment->longitude}}" required>
        </div>
        @error('longitude')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="image">EDIT IMAGE:</label>
            <input type="file" name="image" id="image">
        </div>
        @error('image')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="description">EDIT DESCRIPTION:</label>
            <textarea name="description" id="description" class="form-control text-muted @error('description') is-invalid @enderror" rows="3" placeholder="Add a description">{{ $apartment->description }}</textarea>
        </div>
        @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="n_rooms">EDIT ROOMS:</label>
            <input type="number" name="n_rooms" id="n_rooms" class="form-control @error('n_rooms') is-invalid @enderror" placeholder="Add a n_rooms" aria-describedby="n_roomsHelper" value="{{$apartment->n_rooms}}" required>
        </div>
        @error('n_rooms')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="n_baths">EDIT BATHS:</label>
            <input type="number" name="n_baths" id="n_baths" class="form-control @error('n_baths') is-invalid @enderror" placeholder="Add a n_baths" aria-describedby="n_bathsHelper" value="{{$apartment->n_baths}}" required>
        </div>
        @error('n_baths')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="n_beds">EDIT BEDS:</label>
            <input type="number" name="n_beds" id="n_beds" class="form-control @error('n_beds') is-invalid @enderror" placeholder="Add a n_beds" aria-describedby="n_bedsHelper" value="{{$apartment->n_beds}}" required>
        </div>
        @error('n_beds')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="services">EDIT SERVICES:</label>
            <select multiple class="form-control" name="services[]" id="services">
              <option value="" disabled>Select a service</option>
                  @if($services)
                  @foreach ($services as $service)
                  @if ($errors->any())
                  <option value="{{ $service->id }}" {{ in_array($service->id, old('services')) ? 'selected' : '' }}>{{ $service->name }}</option>
                  @else
                  <option value="{{ $service->id }}" {{ $apartment->services->contains($service) ? 'selected' : '' }}>{{ $service->name }}</option>
                  @endif  
                  @endforeach
                  @endif
            </select>
          </div>

        <div class="form-group d-flex">
            <label for="visible">VISIBLE:</label>
            <input type="radio" name="visible" id="visible" class="form-control @error('visible') is-invalid @enderror" placeholder="Add a visible" aria-describedby="visibleHelper" value="1" required>
            <input type="radio" name="visible" id="visible" class="form-control @error('visible') is-invalid @enderror" placeholder="Add a visible" aria-describedby="visibleHelper" value="0" required>
        </div>

        @error('visible')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    
        <button type="submit" class="btn btn-primary">EDIT</button>
    </form>
</div>


@endsection