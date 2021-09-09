@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card text-left m-3" style="min-height: 800px;">
                    <img class="card-img-top" src="{{ asset('storage/' . $apartment->image) }}" alt="">
                    <div class="card-body">
                        <h2 class="card-title">{{ $apartment->title }}</h2>
                        <h4 class="card-title">{{ $apartment->address }}</h4>
                        <p class="card-text">{{ $apartment->description }}</p>
                        @foreach ($apartment->services as $service)
                            <ul>
                                <li>{{ $service->name }}</li>
                            </ul>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-4">
                <form action="{{ route('send.message', $apartment->id) }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" aria-describedby="nameHelper"
                            placeholder="Add your name">
                        <small id="nameHelper" class="form-text text-muted">Type your name</small>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Lastname</label>
                        <input type="text" class="form-control" name="lastname" id="lastname"
                            aria-describedby="lastnameHelper" placeholder="Add your lastname">
                        <small id="lastnameHelper" class="form-text text-muted">Type your lastname</small>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelper"
                            placeholder="Add your email address" value="{{ $user }}">
                        <small id="emailHelper" class="form-text text-muted">Type your email address</small>
                    </div>
                    <div class="form-group">
                        <label for="body">Message</label>
                        <textarea class="form-control" name="body" id="body" rows="5"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>

    </div>
@endsection
