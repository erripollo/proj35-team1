/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

const { default: axios } = require("axios");
require("./bootstrap");

window.Vue = require("vue");

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",

    data: {
        apartments: null,
        services: null,
        serviceSelected: [],
        url: "https://api.tomtom.com/search/2/search/",
        key: ".json?key=WKV00hGlXHkJdGuro8v49W6Z2GpiQaqA&typeahead=true",

        key2:
            ".json?limit=5&countrySet=it&key=WKV00hGlXHkJdGuro8v49W6Z2GpiQaqA",
        searchCity: "",
        location: null,
        autocomplete: [],
        luogoObj: {},
        latitudine: "",
        longitudine: "",
        latApartment: "",
        lonApartment: "",
        showControl: true,
        filteredApartments: [],
        temp: [],

        rooms: "",
        searchBeds: "",
        range: "20",
        lat1: 0,
        lon1: 0,
        filtered: [],
        apartmentId: ""
    },
    methods: {
        persist() {
            localStorage.location = this.location;
            localStorage.latitudine = this.latitudine;
            localStorage.longitudine = this.longitudine;

            const parsed = JSON.stringify(this.filteredApartments);
            localStorage.setItem("filteredApartments", parsed);
        },

        autocompleteAddress() {
            axios
                .get(this.url + this.location + this.key2)
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
            //this.location = "";
            if (
                item.address.streetNumber &&
                item.address.countrySubdivision &&
                item.address.streetName &&
                item.address.streetNumber
            ) {
                this.location =
                    item.address.municipality +
                    ", " +
                    item.address.countrySubdivision +
                    ", " +
                    item.address.streetName +
                    " " +
                    item.address.streetNumber;
            } else {
                alert(
                    "Inserire indirrizzo corretto (City, Street, Street number)"
                );
                this.location = "";
            }
            //this.location = item.address.municipality + ', ' + item.address.countrySubdivision + ', ' + item.address.streetName + ' ' + item.address.streetNumber;
            this.latitudine = item.position.lat;
            this.longitudine = item.position.lon;
            this.showControl = false;

            localStorage.location = "";
        },

        searchHomePage(item) {
            console.log(item.address.municipality);
            this.luogoObj = item;
            this.location = item.address.municipality;
            this.latitudine = item.position.lat;
            this.longitudine = item.position.lon;
            this.filteredApartments = [];

            /* if (item.address.municipality == this.location) {
                     
                     document.getElementById("search").classList.add('active');
                     document.getElementById("search").classList.remove('disabled');
                 } */

            /*  axios.get('/api/apartments').then(resp => {
                     console.log(resp, 'API APARTMENTS');
                     this.apartments = resp.data.data;
                 }).catch(e => {
                     console.error('Sorry! ' + e);
                 })  */

            //PROVA CALCOLO DISTANZA
            /* console.log(this.apartments, 'Log tutti apartment');
                 var lat1 = 45.1168763;
                 var lon1 = 7.39455;
     
                 var lat2 = 45.07022;
                 var lon2 = 7.6842;
     
                 distance = (6371*3.1415926*Math.sqrt((lat2-lat1)*(lat2-lat1) + Math.cos(lat2/57.29578)*Math.cos(lat1/57.29578)*(lon2-lon1)*(lon2-lon1))/180);
     
                 console.log(distance, 'log prova distanza');
                 console.log(this.latitudine, this.longitudine);
                 console.log(this.apartments[0].latitude, this.apartments[0].longitude); */

            function clacDistance(lat1, lon1, lat2, lon2) {
                var distance =
                    (6371 *
                        3.1415926 *
                        Math.sqrt(
                            (lat2 - lat1) * (lat2 - lat1) +
                                Math.cos(lat2 / 57.29578) *
                                    Math.cos(lat1 / 57.29578) *
                                    (lon2 - lon1) *
                                    (lon2 - lon1)
                        )) /
                    180;
                return distance;
            }

            for (let i = 0; i < this.apartments.length; i++) {
                const el = this.apartments[i];
                //console.log(parseFloat(el.latitude));
                //console.log(this.latitudine);
                var lat = parseFloat(el.latitude);
                var lon = parseFloat(el.longitude);
                var distance = clacDistance(
                    this.latitudine,
                    this.longitudine,
                    lat,
                    lon
                );
                console.log(distance, "Distanza appartamento");

                if (distance <= this.range) {
                    this.filteredApartments.push(el);
                    this.saveApartment();
                }
            }

            this.showControl = false;

            localStorage.location = "";
        },

        saveApartment() {
            const parsed = JSON.stringify(this.filteredApartments);
            localStorage.setItem("filteredApartments", parsed);
        },

        newRange() {
            this.filteredApartments = [];
            this.temp = [];

            function clacDistance(lat1, lon1, lat2, lon2) {
                var distance =
                    (6371 *
                        3.1415926 *
                        Math.sqrt(
                            (lat2 - lat1) * (lat2 - lat1) +
                                Math.cos(lat2 / 57.29578) *
                                    Math.cos(lat1 / 57.29578) *
                                    (lon2 - lon1) *
                                    (lon2 - lon1)
                        )) /
                    180;
                return distance;
            }

            for (let i = 0; i < this.apartments.length; i++) {
                const el = this.apartments[i];
                //console.log(parseFloat(el.latitude));
                //console.log(this.latitudine);
                var lat = parseFloat(el.latitude);
                var lon = parseFloat(el.longitude);
                var distance = clacDistance(
                    this.latitudine,
                    this.longitudine,
                    lat,
                    lon
                );
                console.log(distance, "Distanza appartamento");

                if (distance <= this.range) {
                    this.filteredApartments.push(el);
                    this.saveApartment();
                }
            }

            this.filteredApartments.forEach(apartment => {
                if (
                    this.serviceSelected.every(x =>
                        apartment.servizi.includes(x)
                    )
                ) {
                    this.temp.push(apartment);
                }
            });

            this.filteredApartments = this.temp;
        },

        checkFilter() {
            this.temp = [];
            this.filteredApartments = [];

            function clacDistance(lat1, lon1, lat2, lon2) {
                var distance =
                    (6371 *
                        3.1415926 *
                        Math.sqrt(
                            (lat2 - lat1) * (lat2 - lat1) +
                                Math.cos(lat2 / 57.29578) *
                                    Math.cos(lat1 / 57.29578) *
                                    (lon2 - lon1) *
                                    (lon2 - lon1)
                        )) /
                    180;
                return distance;
            }

            for (let i = 0; i < this.apartments.length; i++) {
                const el = this.apartments[i];
                //console.log(parseFloat(el.latitude));
                //console.log(this.latitudine);
                var lat = parseFloat(el.latitude);
                var lon = parseFloat(el.longitude);
                var distance = clacDistance(
                    this.latitudine,
                    this.longitudine,
                    lat,
                    lon
                );
                console.log(distance, "Distanza appartamento");

                if (distance <= this.range) {
                    this.filteredApartments.push(el);
                    this.saveApartment();
                }
            }
            /* var serviziTemp =[];

                this.filteredApartments.forEach(apartment => {
                    this.serviceSelected.forEach(servizio => {
                        if (apartment.servizi.includes(servizio)) {
                            console.log(servizio, 'servizio ci sta');
                            serviziTemp.push(servizio)
                        }
                    });

                    if(apartment.servizi.sort().join(',').includes(serviziTemp.sort().join(','))){
                        alert('same members');
                    }
                    else alert('not a match');
                });

                if (apartment.servizi.every()) {
                    
                } */

            /*  this.filteredApartments.forEach(apartment => {
                        if (apartment.servizi.includes(this.serviceSelected)) {
                            temp.push(apartment)
                        }else if(temp.includes(apartment)) {
                            temp.splice(apartment, 1)
                        }
                    })
                
                console.log(temp); */
            console.log(this.temp, "log prima ciclo");

            this.filteredApartments.forEach(apartment => {
                if (
                    this.serviceSelected.every(x =>
                        apartment.servizi.includes(x)
                    )
                ) {
                    this.temp.push(apartment);
                }
            });

            this.filteredApartments = this.temp;

            /*  console.log(this.temp, 'log post ciclo');
                if (this.temp.length <= 0) {
                    this.temp.push(
                        {
                            title: 'Nessun risultato'
                        }
                    )
                } */
        },

        showMap(lat, long) {
            coordinates = [long, lat];

            tt.setProductInfo("<test>", "<beta>");
            var map = tt.map({
                key: "WKV00hGlXHkJdGuro8v49W6Z2GpiQaqA",
                container: "map",
                language: "italian",
                style: "tomtom://vector/1/basic-main",
                center: coordinates,
                zoom: 12
            });

            map.addControl(new tt.FullscreenControl());
            map.addControl(new tt.NavigationControl());
            var marker = new tt.Marker().setLngLat(coordinates).addTo(map);
        },

        /* Resetta il value di location nel create  */
        resetStorage() {
            if (
                window.location.href ===
                "http://127.0.0.1:8000/admin/apartments/create"
            ) {
                //console.log("ok");
                this.location = "";
            } else {
                console.log("no");
            }
        },

        changeEditAddress() {
            const url = window.location.href;
            const params = url.split("/");
            const id = parseInt(params[params.length - 2]);
            this.apartmentId = id;
            console.log(id, "log funzione prova edit");

            $appartamento = {};

            axios
                .get(`/api/apartments/one?id=${this.apartmentId}`)
                .then(data => {
                    //console.log(data, "log risposta");
                    appartamento = data.data.data;
                    //console.log(appartamento, "log appartamento");
                    appartamento.forEach(element => {
                        //console.log(element.address, "log indirizzo");
                        this.location = element.address;
                    });
                })
                .catch(error => console.log(error));
        }

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
        axios
            .get("/api/apartments")
            .then(resp => {
                console.log(resp, "PRIMA API CALL");
                this.apartments = resp.data.data;

                this.apartments.forEach(apartment => {
                    //apartment.servizi = 'ciao';
                    //console.log(apartment, 'ema console');
                    apartment.servizi = [];
                    apartment.services.forEach(serviceName => {
                        apartment.servizi.push(serviceName.name);
                    });
                    console.log(apartment, "log servizi array");
                });
            })
            .catch(e => {
                console.error("Sorry! " + e);
            });

        axios
            .get("/api/services")
            .then(resp => {
                console.log(resp, "CALL SERVICES");
                this.services = resp.data.data;
            })
            .catch(e => {
                console.error("Sorry! " + e);
            });

        /* Storage di location e coordinate */
        if (localStorage.location) {
            this.location = localStorage.location;
            this.latitudine = localStorage.latitudine;
            this.longitudine = localStorage.longitudine;
        }

        /* Storage filtered appartamnent */
        if (localStorage.getItem("filteredApartments")) {
            try {
                this.filteredApartments = JSON.parse(
                    localStorage.getItem("filteredApartments")
                );
            } catch (e) {
                localStorage.removeItem("filteredApartments");
            }
        }

        this.resetStorage();
        this.changeEditAddress();
    }
});
