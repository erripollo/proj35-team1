@extends('layouts.admin')

@section('content')
    <div class="container message">
        <div class="row">
            <div class="">
                <div class="card text-left m-3">
                    <div class="col-6">
                        <img class="card-img-top" src="{{ asset('storage/' . $apartment->image) }}" alt="">
                    </div>
                    <div class="col-6 card-body">
                        <h2 class="card-title">{{ $apartment->title }}</h2>
                        <h4 class="card-title">{{ $apartment->address }}</h4>
                        <hr>
                        <div class="text mb-3">
                            <div>FROM:   {{ $message->name }} {{ $message->lastname }}</div>
                            <div>EMAIL:   {{ $message->email }}</div>
                            <div>DATE:    {{ $message->created_at }}</div>
                        </div>
                        <div>
                            <h5>Message :</h5>
                            <p class="card-text">{{ $message->body }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
