@extends('layouts.app')

@section('content')
    <div class="container d-flex flex-column align-items-center">
        <h1 class="mb-4">BoolBnb</h1>
        <div>
            <form action="{{ route('house') }}" method="get">
                @csrf

                {{-- @method('GET') --}}
                <div class="form-group d-flex">
                    <div>
                        <input type="text" v-on:keyup="autocompleteAddress" v-model="location" class="form-control mr-2"
                            name="location" id="location" aria-describedby="helpId" placeholder="Search City">
                        <div v-show="showControl">
                            <ul v-for="item in autocomplete">
                                <li @click="searchHomePage(item)">@{{ item . address . municipality }},
                                    @{{ item . address . countrySubdivision }}</li>
                            </ul>
                        </div>
                    </div>
                    <button v-on:click="persist" type="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>
        </div>
    </div>
@endsection
