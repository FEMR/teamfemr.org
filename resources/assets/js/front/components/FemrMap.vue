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
                        :position="m[0].position"
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
    import VisitedLocation from '../models/VisitedLocation';

    export default {

        components: {

            'femr-info-window': InfoWindow
        },

        data() {

            return {

                center: { lat: 0.0, lng: 0.0 },
                zoom: 2,
                locations: []
            }
        },

        watch: {

            locations: function( newLocations ) {

                this.extendBounds();
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

            extendBounds() {

                const bounds = new google.maps.LatLngBounds();
                _.forEach( this.locations, ( location ) => {

                    bounds.extend( location.position );
                });
                this.$refs.gmap.$mapObject.fitBounds( bounds );
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

                    // TODO -- move to a service
                    axios.get('/api/locations')
                        .then((response) => {

                            this.locations = [];
                            _.forEach( response.data, ( location ) => {

                                let newLoc = new VisitedLocation();
                                newLoc.populate( location );
                                this.locations.push( newLoc );
                            });

                            console.log( this.locations );

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

                this.getLocations();
            });



            window.addEventListener('resize', () => {

                console.log( 'Resize' );
                this.extendBounds();
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