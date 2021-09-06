/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

const { default: axios } = require('axios');
require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    
    data: {
        apartments: null,
        services: null,
        serviceSelected: [],
        url:'https://api.tomtom.com/search/2/search/' ,
        key:'.json?key=WKV00hGlXHkJdGuro8v49W6Z2GpiQaqA',
        
        key2: ".json?limit=5&countrySet=it&key=WKV00hGlXHkJdGuro8v49W6Z2GpiQaqA",
        searchCity: '',
        searchCity2: "",
        autocomplete: [],
        luogoObj: {},
        latitudine: "",
        longitudine: "",
        showControl: true,

        searchRooms: '',
        searchBeds: '',
        range: '20',
        lat1: 0,
        lon1: 0,
        filtered: [],
        
        
    },
    methods:{


        searchApart2() {
            axios
                .get(this.url + this.searchCity2 + this.key2)
                .then(resp => {
                    console.log(resp, "CALL TOMTOM");
                    this.autocomplete = resp.data.results;
                    /*  this.lat1 = resp.data.results[0].position.lat;
                    this.lon1 = resp.data.results[0].position.lon; */
                })
                .catch(e => {
                    console.error("Sorry! " + e);
                });

                this.showControl = true;
        },
        luogo(item) {
            console.log(item.address.municipality);
            this.luogoObj = item;
            //this.searchCity2 = "";
            if (item.address.streetNumber && item.address.countrySubdivision && item.address.streetName && item.address.streetNumber) {
                this.searchCity2 = item.address.municipality + ', ' + item.address.countrySubdivision + ', ' + item.address.streetName + ' ' + item.address.streetNumber;
            }else{
                alert ('Inserire indirrizzo corretto (Città, Via, Numero civico)');
                this.searchCity2 = '';
            }
            //this.searchCity2 = item.address.municipality + ', ' + item.address.countrySubdivision + ', ' + item.address.streetName + ' ' + item.address.streetNumber;
            this.latitudine = item.position.lat;
            this.longitudine = item.position.lon;
            this.showControl = false;
        },
        
        /* searchApart(){
            axios.get(this.url + this.searchCity + this.key).then(resp => {
                console.log(resp, 'CALL TOMTOM');
                this.lat1 = resp.data.results[0].position.lat;
                this.lon1 = resp.data.results[0].position.lon;
            }).catch(e => {
                console.error('Sorry! ' + e);
            })

            function calcDistance(lat2, lon2) {
                
                var distance;

                distance = (6371*3.1415926*Math.sqrt((lat2-this.lat1)*(lat2-this.lat1) + Math.cos(lat2/57.29578)*Math.cos(this.lat1/57.29578)*(lon2-this.lon1)*(lon2-this.lon1))/180);
                console.log(distance);
                return distance
            }

            this.apartments.forEach(apartment => {
                calcDistance(apartment.lat, apartment.lon)
                if (distance <= this.range) {
                    this.filtered.push(apartment)
                }
            });


            
        } */
        
    },

    mounted() {

        axios.get('/api/apartments').then(resp => {
            console.log(resp, 'PRIMA API CALL');
            this.apartments = resp.data.data;
        }).catch(e => {
            console.error('Sorry! ' + e);
        }) 

        axios.get('/api/services').then(resp => {
            console.log(resp, 'PRIMA API CALL');
            this.services = resp.data.data;
        }).catch(e => {
            console.error('Sorry! ' + e);
        }) 

    }
});

