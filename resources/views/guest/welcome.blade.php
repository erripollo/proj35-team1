@extends('layouts.app')

@section('content')
    <div class="container d-flex flex-column align-items-center">
        <h1 class="mb-4">BoolBnb</h1>
        <div>
            <form action="{{ route('house') }}" method="get">
                @csrf

                {{-- @method('GET') --}}
                <div class="d-flex align-items-start">
                    <div class="form-group">
                        <div>
                            <input type="text" v-on:keyup="autocompleteAddress" v-model="location" class="form-control mr-2"
                                name="location" id="location" aria-describedby="helpId" placeholder="Search City"
                                style="width: 300px">
                            <div v-show="showControl">
                                {{-- <div class="list-group">
                                    <button v-for="item in autocomplete" @click="searchHomePage(item)" type="button"
                                        class="list-group-item list-group-item-action">@{{ item . address . municipality }},
                                        @{{ item . address . countrySubdivision }}</button>
                                </div> --}}
                                <div class="list-group">
                                    <a v-for="item in autocomplete" @click="searchHomePage(item)" href="#"
                                        class="list-group-item list-group-item-action">@{{ item . address . municipality }},
                                        @{{ item . address . countrySubdivision }}</a>
                                </div>
                                {{-- <ul v-for="item in autocomplete">
                                    <li @click="searchHomePage(item)">@{{ item . address . municipality }},
                                        @{{ item . address . countrySubdivision }}</li>
                                </ul> --}}
                            </div>
                        </div>
                    </div>
                    {{-- <button v-on:click="persist" type="submit" class="btn btn-primary">Submit</button> --}}
                    {{-- <button v-on:click="persist" type="button" class="btn btn-primary">Primary</button> --}}
                    <a v-on:click="persist" name="search" id="search" class="btn btn-primary"
                        :class="(location) ? 'active' : 'disabled' " href="{{ route('house') }}" role="button">Search</a>
                </div>

            </form>
        </div>
    </div>
@endsection
