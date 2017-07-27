<template>
    <div class="map-container">

        <!--<div class="search">-->

            <!--<p>Search stuff will go here</p>-->

        <!--</div>-->
        <gmap-map
                ref="gmap"
                :center="center"
                :zoom="zoom"
                :options="{ scrollwheel: false }"
                class="map">
            <gmap-cluster :grid-size="40">

                <f-info-window ref="infoWindow"></f-info-window>
                <gmap-marker
                        :key="index"
                        v-for="(m, index) in locations"
                        :position="{ lat: m.latitude, lng: m.longitude }"
                        :clickable="true"
                        :draggable="false"
                        :opened="false"
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

            'f-info-window': InfoWindow
        },
        data() {

            return {

                center: { lat: 0.0, lng: 0.0 },
                bounds: {},
                zoom: 2,
                locations: []
            }
        },
        methods: {

            toggleInfoWindow( location, idx ) {

                this.$refs.infoWindow.toggleInfoWindow( location, idx );
            }
        },
        mounted() {

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
        }
    }

</script>

<style scoped>



</style>