<template>
    <div class="map-container">
        <gmap-map
                ref="gmap"
                :center="center"
                :zoom="zoom"
                :options="{ scrollwheel: false }"
                class="map">
            <gmap-cluster :grid-size="50">

                <femr-info-window ref="infoWindow"></femr-info-window>
                <gmap-marker
                        :key="index"
                        v-for="(m, index) in groupedLocations"
                        :position="{ lat: m[0].latitude, lng: m[0].longitude }"
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

        components: {

            'femr-info-window': InfoWindow
        },
        data() {

            return {

                center: { lat: 0.0, lng: 0.0 },
                bounds: {},
                zoom: 2,
                locations: []
            }
        },
        computed: {

          groupedLocations: function(){

            return _.groupBy( this.locations, ( location ) => {

               return location.latitude + ', ' + location.longitude;
            });
          }

        },
        methods: {

            toggleInfoWindow( locations, idx ) {

                console.log( locations );

                this.$refs.infoWindow.toggle( locations, idx );
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

                axios.get( '/api/locations' )
                        .then( ( response ) => {

                            _.forEach( response.data, ( location ) => {

                                this.locations.push( location );
                                this.extendBounds( location );
                            });

                            //console.log( this.groupedLocations );
                        })
                        .catch( ( error ) => { console.log(error); });
            }
        },
        created() {

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