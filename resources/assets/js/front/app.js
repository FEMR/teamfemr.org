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

import FemrMap from './components/FemrMap';
Vue.component( 'femr-map', FemrMap );

import ProgramMap from './components/ProgramMap';
Vue.component( 'program-map', ProgramMap );

import AllProgramsModal from './components/AllProgramsModal';
Vue.component( 'all-programs-modal', AllProgramsModal );


const app = new Vue({

    el: '#app',
    data(){

        return {
            

        }
    },
    methods: {

        /**
         * Since the homepage is currently a single page, native browser hash scrolling to the
         *  appropriate sections doesn't take into account the offset from the header. Rather than
         *  temporarily doing something odd with css, it seems better to just catch the hash with js
         *  and scroll with the vue-scrollto directive
         */
        scrollToHash(){

            // check the current url for a hash tag, if present scroll to this section
            if( window.location.hash ) {

                // Scroll to the current hash
                this.$scrollTo( window.location.hash );
            }
        },

        /**
         * Bind the menu hide/show actions
         *
         * TODO - vue-ify this code with a component
         *
         */
        setupMobileMenuToggle(){

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
    },

    created() {

        this.scrollToHash();
    },

    mounted(){

        this.setupMobileMenuToggle();
    }
});