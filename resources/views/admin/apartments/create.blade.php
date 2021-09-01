@extends('layouts.admin')

@section('content')

<h1 class="text-center pt-3 pb-3">ADD A NEW APARTMENT</h1>

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
            <label for="title">TITLE:</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Add a title" aria-describedby="titleHelper" value="{{old('title')}}" required>
        </div>
        @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="city">CITY:</label>
            <input type="text" name="city" id="city" class="form-control @error('city') is-invalid @enderror" placeholder="Add a city" aria-describedby="cityHelper" value="{{old('city')}}" required>
        </div>
        @error('city')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="address">ADDRESS:</label>
            <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="Add a address" aria-describedby="addressHelper" value="{{old('address')}}" required>
        </div>
        @error('address')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="latitude">LATITUDE:</label>
            <input type="number" step="0.000001" name="latitude" id="latitude" class="form-control @error('latitude') is-invalid @enderror" placeholder="Add a latitude" aria-describedby="latitudeHelper" value="{{old('latitude')}}" required>
        </div>
        @error('latitude')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="longitude">LONGITUDE:</label>
            <input type="number" step="0.000001" name="longitude" id="longitude" class="form-control @error('longitude') is-invalid @enderror" placeholder="Add a longitude" aria-describedby="longitudeHelper" value="{{old('longitude')}}" required>
        </div>
        @error('longitude')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="image">IMAGE:</label>
            <input type="file" name="image" id="image">
        </div>
        @error('image')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="description">DESCRIPTION:</label>
            <textarea name="description" id="description" class="form-control text-muted @error('description') is-invalid @enderror" rows="3" placeholder="Add a description">{{ old('description') }}</textarea>
        </div>
        @error('description')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="n_rooms">ROOMS:</label>
            <input type="number" name="n_rooms" id="n_rooms" class="form-control @error('n_rooms') is-invalid @enderror" placeholder="Add a n_rooms" aria-describedby="n_roomsHelper" value="{{old('n_rooms')}}" required>
        </div>
        @error('n_rooms')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="n_baths">BATHS:</label>
            <input type="number" name="n_baths" id="n_baths" class="form-control @error('n_baths') is-invalid @enderror" placeholder="Add a n_baths" aria-describedby="n_bathsHelper" value="{{old('n_baths')}}" required>
        </div>
        @error('n_baths')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
            <label for="n_beds">BEDS:</label>
            <input type="number" name="n_beds" id="n_beds" class="form-control @error('n_beds') is-invalid @enderror" placeholder="Add a n_beds" aria-describedby="n_bedsHelper" value="{{old('n_beds')}}" required>
        </div>
        @error('n_beds')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group">
          <label for="services">SERVICES</label>
          <select multiple class="form-control" name="services[]" id="services">
            <option value="" disabled>Select a tag</option>
                @if($services)
                @foreach ($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
                @endif
          </select>
        </div>
        @error('services')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="form-group d-flex">
            <label for="visible">VISIBLE:</label>
            <input type="radio" name="visible" id="visible" class="form-control @error('visible') is-invalid @enderror" placeholder="Add a visible" aria-describedby="visibleHelper" value="1" required>
            <input type="radio" name="visible" id="visible" class="form-control @error('visible') is-invalid @enderror" placeholder="Add a visible" aria-describedby="visibleHelper" value="0" required>
        </div>

        @error('visible')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    
        <button type="submit" class="btn btn-primary mr-3">CREATE</button>
        <button class="btn btn-danger"><a class="text-white text-decoration-none" href="{{ route('admin.apartments.index') }}">CANCEL</a></button>
    </form>
</div>


@endsection