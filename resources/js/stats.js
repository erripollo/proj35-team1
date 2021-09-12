const { default: axios } = require('axios');
require('./bootstrap');
import { Chart, registerables } from 'chart.js';
Chart.register(...registerables);
window.Vue = require('vue');





/* var ctx = document.getElementById('myChart').getContext('2d');


var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
}); */






   


var app = new Vue({
    el: '#stats',

    data: {
        apartmentId: "",
        views: [],
        messages: {},
        statsData: {},

        years: [],
        selectedYear: "",
        graphType: "",
        activeGraph: false,
        graph: {},
        noStats: false,
    },

    methods: {

        getApartmentId: function() {

            const url = window.location.href;
            const params = url.split("/");
            const id = parseInt(params[params.length -1]);
            this.apartmentId = id;
            console.log(id);
        },

        getViews: function() {

            axios
                .get (`/api/visits?id=${this.apartmentId}`)
                .then(data => {
                    
                    this.views = data.data;
                    console.log(this.views, 'log views');
                })
                .catch(error => console.log(error));

                
        },

        getMessages: function() {

            axios
                .get (`/api/messages?id=${this.apartmentId}`)
                .then(data => {
                    
                    this.messages = data.data;
                    console.log(this.messages, 'log messages');
                })
                .catch(error => console.log(error));

                
        },

         generateStats: function(year) {
                
                if(this.activeGraph) {
                    this.graph.destroy();
                }
                
                this.selectedYear = year;
                const months = ['Gen', 'Feb', 'Mar', 'Apr', 'Mag', 'Giu', 'Lug', 'Ago', 'Set', 'Ott', 'Nov', 'Dic'];
                let stats = [0,0,0,0,0,0,0,0,0,0,0,0];
                this.statsData[this.selectedYear].forEach(month => {
                    stats[month-1]++;
                });
                
                // Chart.js
                const ctx = document.getElementById('statsChart').getContext('2d');
                let myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: months, 
                        datasets: [{
                            label: (this.graphType == 'views') ? 'Visualizzazioni' : 'Messaggi',
                            data: stats,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }],
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        },

                        layout: {
                            padding: {
                                left: 20
                            }
                        },

                        responsive: true
                    }
                });

                this.activeGraph = true;
                this.graph = myChart;
            },

            generateData: function(type) {
                
                this.graphType = type;
                (this.graphType == 'views') ? this.statsData = this.views : this.statsData = this.messages;
                this.years = Object.keys(this.statsData);
                this.noStats = false;

                if(Object.entries(this.statsData).length === 0) {
                    this.noStats = true;
                    if(this.activeGraph) {
                        this.graph.destroy();
                    }
                    return 
                }

                this.generateStats(new Date().getFullYear())

            }

        


    },

       

    mounted() {
        this.getApartmentId()
        this.getViews()
        this.getMessages()
    }
})