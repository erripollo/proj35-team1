@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class=" offset-2 col-8 offset-2">
                <div class="card text-left m-3" style="min-height: 800px;">
                    <img class="card-img-top" src="{{ asset('storage/' . $apartment->image) }}" alt="">
                    <div class="card-body">
                        <h2 class="card-title">{{ $apartment->title }}</h2>
                        <h4 class="card-title">{{ $apartment->address }}</h4>
                        <hr>
                        <div class="mb-3">
                            <div>From: {{ $message->name }} {{ $message->lastname }}</div>
                            <div>Email: {{ $message->email }}</div>
                            <div>Date: {{ $message->created_at }}</div>
                        </div>
                        <div>
                            <h5>Message:</h5>
                            <p class="card-text">{{ $message->body }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
