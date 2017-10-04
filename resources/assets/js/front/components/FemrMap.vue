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

    import store from 'store';
    import expirePlugin from 'store/plugins/expire';
    store.addPlugin(expirePlugin);

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

                console.log( 'Fit Bounds' );
                console.log( this.bounds );

                if( ! _.isEmpty( this.bounds ) && this.locations.length > 1 ) {

                    this.$refs.gmap.fitBounds( this.bounds );
                }
                else if( this.locations.length > 0 ) {

                    let location = this.locations[0];
                    this.center = location.position;
                    this.zoom = 7;
                }

            },

            extendBounds( location ) {

                let latLng = new google.maps.LatLng( location.latitude, location.longitude );
                this.bounds.extend( latLng );

                this.fitBounds();
            },

            getLocations() {

                //
                let cachedLocations = store.get( 'FEMR.locations' );

                if( cachedLocations ) {

                    console.log( "loaded from cache" );
                    this.locations = cachedLocations;
                }
                // If no previous locations, get from aPI
                else {

                    axios.get('/api/locations')
                        .then((response) => {

                            _.forEach(response.data, (location) => {

                                this.locations.push(location);
                                this.extendBounds(location);
                            });

                            // put the locations in local storage
                            store.set('FEMR.locations', this.locations, Date.now() + 30 * 60 * 1000 /* 30 minutes in ms */);

                            //console.log( this.groupedLocations );
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                }
            }
        },
        created() {

            VueGoogleMaps.loaded.then( () => {

                console.log('Map Library Loaded');

                this.initBounds();
                this.getLocations();
            });



            window.addEventListener('resize', () => {
                console.log( 'Resize' );

                //this.fitBounds();
                //_.throttle( this.fitBounds, 200 );

            });
        }
    }

</script>

<style lang="scss" scoped>

    .map-container{

        position: relative;
        width: 100%;
        padding-top: 60%;

        .map {

            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }
    }


</style>