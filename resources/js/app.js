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

        url:'https://api.tomtom.com/search/2/search/' ,

        key:'.json?key=qRO17xCJNDBuG8WyLOU0pOgHavh2B2un',

        searchCity: 'Milano',

        // fullUrl : url + searchCity + key,
        
    },
    methods:{
        searchApart(){
            axios.get('https://api.tomtom.com/search/2/geocode/Milano.json?key=qRO17xCJNDBuG8WyLOU0pOgHavh2B2un').then(resp => {
                console.log(resp, 'CALL TOMTOM');
            }).catch(e => {
                console.error('Sorry! ' + e);
            })
        }
    },

    mounted() {

        //console.log(this.fullUrl, 'FULLurl')
        axios.get('/api/apartments').then(resp => {
            console.log(resp, 'PRIMA API CALL');
            this.apartments = resp.data.data;
        }).catch(e => {
            console.error('Sorry! ' + e);
        }) 
    }
});