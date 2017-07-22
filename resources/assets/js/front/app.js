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
    onDone: () => {
        
        // TODO - handle this better
        app.showTopButton();
    },
    onCancel: false
});

import SlackModal from './components/SlackModal';
Vue.component( 'slack-modal', SlackModal );

import SlackInvite from './components/SlackInvite';
Vue.component( 'slack-invite', SlackInvite );

const app = new Vue({

    el: '#app',
    data(){

        return {

            showTopLink: false,

            center: { lat: 0.0, lng: 0.0 },
            bounds: {},
            zoom: 2,
            locations: [],

            infoContent: '',
            infoWindowPos: {
                lat: 0,
                lng: 0
            },
            infoWinOpen: false,
            currentMidx: null,
            //optional: offset infowindow so it visually sits nicely on top of our marker
            infoOptions: {
                pixelOffset: {
                    width: 0,
                    height: -35
                }
            }
        }
    },
    methods: {

        toggleInfoWindow( location, idx ) {

            this.infoWindowPos = { lat: location.latitude, lng: location.longitude };
            this.infoContent = `
                <div class="map-info-window">
                        <p>${ location.outreach_program.name }</p>
                        <p v-if="location.outreach_program.school"><strong>School:</strong> ${ location.outreach_program.school.name }</p>
                        <p>
                            <strong>Location: </strong>
                            ${ location.administrative_area_level_1 ? '<span class="city">' + location.administrative_area_level_1 + '</span>' : '' }
                            ${ location.administrative_area_level_1 && location.country ? '<span class="sep">,</span>' : '' }
                            ${ location.country ? '<span class="country">' + location.country + '</span>' : '' }
                        </p>
                        <p>
                            <a
                                    class="button femr-button"
                                    href="/programs/${ location.outreach_program.slug }"
                                    target="_blank"
                                    style="margin: 10px auto; font-size: 0.8rem;"
                            >
                                More Info &raquo;
                            </a>
                        </p>
                    </div>
            `;
            //check if its the same marker that was selected if yes toggle
            if (this.currentMidx == idx) {
                this.infoWinOpen = !this.infoWinOpen;
            }
            //if different marker set infowindow to open and reset current marker index
            else {
                this.infoWinOpen = true;
                this.currentMidx = idx;
            }
        },

        showTopButton(){

            // if( this.showTopLink == false ) {
            //
            //     this.showTopLink = true;
            // }
        },

        goToTop() {

            // this.showTopLink = false;
            // VueScrollTo.scrollTo( '#top-bar' );

        }
    },
    mounted(){

        VueGoogleMaps.loaded.then( () => {

            console.log('the google map library has been loaded');
            this.bounds = new google.maps.LatLngBounds();

            axios.get( 'api/locations' )
                .then( ( response ) => {

                    _.forEach( response.data, ( location ) => {

                        let latLng = new google.maps.LatLng(location.latitude, location.longitude);
                        this.locations.push( location );

                        this.bounds.extend(latLng);
                        this.$refs.gmap.fitBounds( this.bounds );
                    });

                    console.log( response.data );
                })
                .catch( ( error ) => { console.log(error); });
        });

        window.addEventListener('resize', () => {

            this.$refs.gmap.fitBounds( this.bounds );
        });


        // TODO - Do this better if this mobile menu is kept

        // Show mobile menu
        let burger = document.querySelector('.nav-toggle');
        let menu = document.querySelector('.nav-menu');
        burger.addEventListener('click', function() {

            burger.classList.toggle('is-active');
            menu.classList.toggle('is-active');
        });

        // hide mobile menu when item is clicked
        let nav = document.querySelector('.nav-right');
        let nav_items = document.querySelectorAll('a.nav-item');
        console.log( nav_items );
        _.forEach( nav_items, ( nav_item ) => {

            nav_item.addEventListener('click', function() {

                console.log( window.innerWidth );

                // If is mobile
                if( window.innerWidth <= 768 ) {

                    burger.classList.remove('is-active');
                    menu.classList.remove('is-active');
                }
            });
        });


    }
});