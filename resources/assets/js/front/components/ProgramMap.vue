<template>
    <div class="map-container">

        <gmap-map
                ref="gmap"
                :center="center"
                :zoom="zoom"
                :options="{ scrollwheel: false }"
                class="map">
            <gmap-cluster :grid-size="50">

                <gmap-info-window
                        ref="infoWindow"
                        :options="options"
                        :position="position"
                        :opened="opened"
                        :content="content"
                ></gmap-info-window>
                <gmap-marker
                        :key="index"
                        v-for="(m, index) in locations"
                        :position="{ lat: m.latitude, lng: m.longitude }"
                        :title="m.country"
                        :clickable="true"
                        :draggable="false"
                        @click="toggleInfoWindow(m,index)"
                >
                </gmap-marker>

            </gmap-cluster>
        </gmap-map>

    </div>
</template>

<script type="text/babel">

    import * as VueGoogleMaps from 'vue2-google-maps';

    import InfoWindow from './InfoWindow';

    export default {

        props: [ 'programId' ],

        components: {

            'femr-info-window': InfoWindow
        },
        data() {

            return {

                opened: false,
                content: '',
                position: {
                    lat: 0,
                    lng: 0
                },
                marker_index: null,

                // InfoWindow Options
                // https://developers.google.com/maps/documentation/javascript/reference#InfoWindowOptions
                options: {

                    pixelOffset: {

                        width: 0,
                        height: -35
                    }
                },

                center: { lat: 0.0, lng: 0.0 },
                bounds: {},
                zoom: 2,
                locations: []
            }
        },
        methods: {

            toggleInfoWindow( location, clicked_index ) {

                // If the current marker is clicked, toggle the window
                if( this.marker_index == clicked_index ) {

                    this.opened = ! this.opened;
                }
                // Different marker clicked
                else {

                    this.opened = false;
                    this.content = "<div style=\"padding-right: 10px; font-size: 1.1rem;\">" + location.city_state_country + "</div>";
                    this.position = { lat: location.latitude, lng: location.longitude };
                    this.marker_index = clicked_index;

                    // Opening the info window is how gmaps pulls the window into view.
                    // The delay is being used to trigger this. Maybe there is a better way?
                    setTimeout(() => { this.opened = true; }, 10);
                }
            },

            initBounds() {

                this.bounds = new google.maps.LatLngBounds();
            },

            fitBounds() {

                if( ! _.isEmpty( this.bounds ) ) {

                    this.$refs.gmap.fitBounds( this.bounds );
                }
            },

            extendBounds( location ) {

                let latLng = new google.maps.LatLng( location.latitude, location.longitude );
                this.bounds.extend( latLng );

                this.fitBounds();
            },

            getLocations() {

                axios.get( '/api/programs/' + this.programId )
                        .then( ( response ) => {

                            _.forEach( response.data.visited_locations, ( location ) => {

                                this.locations.push( location );
                                this.extendBounds( location );
                            });

                        })
                        .catch( ( error ) => { console.log(error); });
            }
        },
        mounted() {

            VueGoogleMaps.loaded.then( () => {

                console.log('Map Library Loaded');

                this.initBounds();
                this.getLocations();
            });

            window.addEventListener('resize', () => {

                this.fitBounds();
            });
        }
    }

</script>

<style scoped>



</style>