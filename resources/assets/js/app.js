require('./bootstrap');


import * as VueGoogleMaps from 'vue2-google-maps';
Vue.use( VueGoogleMaps, {
    load: {
        key: FEMR.googleMapsKey,
        libraries: 'places'
    }
});


import SlackInvite from './components/SlackInvite';
Vue.component( 'slack-invite', SlackInvite );

const app = new Vue({

    el: '#app',
    data(){

        return {

            center: { lat: 0.0, lng: 0.0 },
            bounds: {},
            zoom: 2,
            markers: []
        }
    },
    methods: {


    },
    mounted(){

        VueGoogleMaps.loaded.then( () => {

            console.log('the google map library has been loaded');
            this.bounds = new google.maps.LatLngBounds();
        });

        axios.get( 'api/locations' )
            .then( ( response ) => {

                _.forEach( response.data, ( location ) => {

                    let latLng = new google.maps.LatLng(location.latitude, location.longitude);
                    this.markers.push(
                        {
                            position: latLng
                        }
                    );

                    this.bounds.extend(latLng);
                    this.$refs.gmap.fitBounds( this.bounds );
                });

                console.log( response.data );
            })
            .catch( ( error ) => { console.log(error); });


        // TODO - Do this better if this mobile menu is kept
        let burger = document.querySelector('.nav-toggle');
        let menu = document.querySelector('.nav-menu');
        burger.addEventListener('click', function() {

            burger.classList.toggle('is-active');
            menu.classList.toggle('is-active');
        });
    }
});