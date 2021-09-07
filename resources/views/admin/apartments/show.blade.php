@extends('layouts.app')

@section('content')
    
<div class="container">
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
        
</div>

@endsection