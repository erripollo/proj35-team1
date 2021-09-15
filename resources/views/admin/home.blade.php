@extends('layouts.admin')

@section('content')
    <div class="container">

        <div class="text-center mt-3 mb-5">
            <H1>Benvenuto {{ Auth::user()->name }}</H1>
        </div>

        <div class="row">
            <div class="col-12 d-flex justify-content-lg-around">
                <div class="col-5 d-flex justify-content-around">
                    <a href="{{ route('admin.apartments.index') }}" style="text-decoration: none">
                        <div class="d-flex text-center justify-content-center align-items-center p-3" style="background-color:rgb(52 144 220 / 70%); width:300px; height: 150px; border-radius: 15px;">
                            <h3 style="color:white;">VAI AI TUOI APPARTAMENTI</h3>
                        </div>
                    </a>
                </div>
                <div class="col-5 d-flex justify-content-around">
                    <a href="{{ route('admin.messages.index') }}" style="text-decoration: none">
                        <div class="d-flex text-center justify-content-center align-items-center p-3" style="background-color:rgb(52 144 220 / 70%); width:300px; height: 150px; border-radius: 15px;">
                            <h3 style="color:white;">VAI AI TUOI MESSAGGI</h3>
                        </div>
                    </a>
                </div>
            </div>

        </div>

    </div>
@endsection
