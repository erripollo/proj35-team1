@extends('layouts.stats')

@section('content')
    <div id="stats">

        {{-- <canvas id="myChart" width="400" height="400"></canvas> --}}

        <div class="container">
            <h1 class="mb-3">
                <span class="username">
                    {{ $user->name }}
                </span>
                - Le tue statistiche
            </h1>


            <a name="" id="" class="btn btn-primary mr-3" href="#" role="button" v-on:click="generateData('views')"
                v-bind:class="(graphType == 'views') ? 'active' : ''">Visualizzazioni</a>
            {{-- <li v-bind:class="(graphType == 'views') ? 'active' : ''">
                    <a class="button-link" v-on:click="generateData('views')">Visualizzazioni</a>
                </li> --}}
            <a name="" id="" class="btn btn-primary" href="#" role="button" v-on:click="generateData('messages')"
                v-bind:class="(graphType == 'messages') ? 'active' : ''">Messaggi</a>
            {{-- <li v-bind:class="(graphType == 'messages') ? 'active' : ''">
                    <a class="button-link" v-on:click="generateData('messages')">Messaggi</a>
                </li> --}}


            <div class="wrapper-statistics">
                <aside>
                    <a class="btn btn-outline-secondary btn-sm my-4 mr-2" v-for="year in years"
                        v-on:click="generateStats(year)">
                        @{{ year }}
                    </a>
                    {{-- <ul class="years-list">
                        <li v-for="year in years">
                            <a v-on:click="generateStats(year)">
                                @{{ year }}
                            </a>
                        </li>
                    </ul> --}}
                </aside>
                <div class="wrapper-graph">
                    <div class="no-stats-text" v-if="noStats">Non ci sono statistiche da visualizzare!</div>
                    <canvas v-else id="statsChart" aria-label="Statistiche">
                        <p>Il tuo dispositivo non supporta il canvas</p>
                    </canvas>
                </div>
            </div>
        </div>
    </div>

@endsection
