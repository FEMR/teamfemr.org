require('./bootstrap');

import * as VueGoogleMaps from 'vue2-google-maps';

Vue.use( VueGoogleMaps, {
    load: {
        key: FEMR.googleMapsKey,
        libraries: 'places'
    }
});

var VueScrollTo = require('vue-scrollto');
Vue.use(VueScrollTo, {
    container: "body",
    duration: 500,
    easing: "ease",
    offset: -130,
    cancelable: true,
    onCancel: false
});

import SlackInvite from './components/SlackInvite';
Vue.component( 'slack-invite', SlackInvite );

import Map from './components/Map';
Vue.component( 'f-map', Map );

const app = new Vue({

    el: '#app',
    data(){

        return {
            

        }
    },
    methods: {

        
    },
    mounted(){

        // Toggle mobile menu
        let burger = document.querySelector('.nav-toggle');
        let menu = document.querySelector('.nav-menu');
        burger.addEventListener('click', function() {

            burger.classList.toggle('is-active');
            menu.classList.toggle('is-active');
        });

        // hide mobile menu when item is clicked
        let nav = document.querySelector('.nav-right');
        let nav_items = document.querySelectorAll('a.nav-item');
        _.forEach( nav_items, ( nav_item ) => {

            nav_item.addEventListener('click', function() {

                // If is mobile
                if( window.innerWidth <= 768 ) {

                    burger.classList.remove('is-active');
                    menu.classList.remove('is-active');
                }
            });
        });
        
    }
});