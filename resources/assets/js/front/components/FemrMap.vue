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
                        v-for="( m, index ) in groupedLocations"
                        :position="m[0].position"
                        :clickable="true"
                        :draggable="false"
                        @click="toggleInfoWindow( m, index )"
                >
                </gmap-marker>

            </gmap-cluster>
        </gmap-map>

    </div>
</template>

<script type="text/babel">

    import * as VueGoogleMaps from 'vue2-google-maps';
    import InfoWindow from './InfoWindow';
    import VisitedLocation from '../models/VisitedLocation';
    import OutreachProgram from '../services/OutreachProgram';

    export default {

        components: {

            'femr-info-window': InfoWindow
        },

        data() {

            return {

                center: { lat: 0.0, lng: 0.0 },
                zoom: 2,
                programs: []
            }
        },

        watch: {

            locations: function( newLocations ) {

                console.log( 'Locations Changed' );
                this.extendBounds();
            }
        },

        computed: {

            groupedLocations: function(){

                // get the locations from each program into 1 array
                const locations = _.transform( this.programs, ( accumulator, program ) => {

                    accumulator =  _.merge( accumulator, program.visitedLocations );
                    return true;

                }, [] );

                // group by the lat/lng coords to handle overlapping pins
                return _.groupBy( locations, ( location ) => {

                   return location.latitude + ', ' + location.longitude;
                });
            }

        },

        methods: {

            toggleInfoWindow( locations, idx ) {

                // get the clicked on locations
                const locationIds = _.map( locations, 'id' );

                // find the programs for the locations
                let programs = _.transform( this.programs, ( result, program ) => {

                    let newProgram = _.cloneDeep( program );

                    // filter the locations to those that were clicked on
                    const filtered_locations = _.filter( newProgram.visitedLocations, ( location ) => {

                        return _.includes( locationIds, location.id );
                    } );

                    // only keep programs with matching locations
                    if( filtered_locations.length > 0 ) {

                        newProgram.visitedLocations = filtered_locations;
                        result.push( newProgram );
                    }
                    return true;

                }, [] )

                // send the programs to show to the infoWindow
                this.$refs.infoWindow.toggle( programs, idx );
            },

            extendBounds() {

                console.log( "Extend Bounds" );

                const bounds = new google.maps.LatLngBounds();
                _.forEach( this.programs, ( program ) => {

                    _.forEach( program.visitedLocations, ( location ) => {

                        bounds.extend( location.position );
                    })
                });
                this.$refs.gmap.$mapObject.fitBounds( bounds );

            },

            getLocations() {

                OutreachProgram.index( ( programs ) => this.programs = programs );
            }
        },
        created() {

            VueGoogleMaps.loaded.then( () => {

                console.log('Map Library Loaded');

                window.addEventListener('resize', _.debounce( this.extendBounds, 500, {}, false ) );

                this.getLocations();
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