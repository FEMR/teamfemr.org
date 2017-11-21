<template>

    <div class="container search-container">

        <div class="columns is-mobile wrap">

            <div class="column filters-container">

                <template v-if="fieldsDefIsLoaded">

                    <div class="field">

                        <template v-if="isLocationSearch">
                            <gmap-autocomplete
                                ref="autocomplete"
                                v-model="autocompleteValue"
                                :value="searchText"
                                class="input"
                                placeholder="Enter a city, state or country"
                                @place_changed="locationChanged"
                                @keyup.enter.prevent
                            ></gmap-autocomplete>
                        </template>
                        <template v-else>
                            <text-field
                                v-model="searchText"
                                :def="fieldsDef.searchText"
                            ></text-field>
                        </template>
                    </div>


                    <div class="tabs is-toggle small search-type-tabs">
                        <ul>
                            <li :class="{ 'is-active': isLocationSearch }" @click="isLocationSearch = true">
                                <a>
                                    <span>Search By Location</span>
                                </a>
                            </li>
                            <li :class="{ 'is-active': ! isLocationSearch }" @click="isLocationSearch = false">
                                <a>
                                    <span>Search By Name</span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="results-container">

                        <div class="results-wrapper">
                            <table class="table">

                                <tr v-for="( program, index ) in programs">
                                    <td>{{ program.name }}</td>
                                    <td>
                                        <button @click="showProgramInfoWindow( program )" class="button is-info is-small">View</button>
                                    </td>
                                </tr>

                            </table>
                        </div>
                    </div>

                </template>

            </div>

            <div class="column map-container">
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

        </div>

    </div>

</template>

<script type="text/babel">

    import * as VueGoogleMaps from 'vue2-google-maps';
    import InfoWindow from './InfoWindow';
    import Switches from 'vue-switches';

    import VisitedLocation from '../models/VisitedLocation';

    import OutreachProgram from '../services/OutreachProgram';
    import Search from '../services/Search';

    export default {

        components: {

            'femr-info-window': InfoWindow,
            Switches
        },

        data() {

            return {

                fieldsDef: {},

                searchText: '',
                autocompleteValue: '',
                location: '',
                sortBy: '',
                isLocationSearch: true,

                isLoading: false,

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

            allFilters: function() {

              return {

                  searchText: this.searchText,
                  latitiude: this.location.latitude,
                  longitude: this.location.longitude
              }
            },

            fieldsDefIsLoaded: function() {

                return ! _.isEmpty( this.fieldsDef );
            },

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

            locationChanged( place ){

                console.log( place );
            },

            toggleInfoWindow( locations, idx ) {

                // get the clicked on locations
                const locationIds = _.map( locations, 'id' );

                // find the programs for the locations
                let programs = _.transform( this.programs, ( result, program ) => {

                    let newProgram = _.cloneDeep( program );

                    // filter the locations to those that were clicked on
                    const filteredLocations = _.filter( newProgram.visitedLocations, ( location ) => {

                        return _.includes( locationIds, location.id );
                    } );

                    // only keep programs with matching locations
                    if( filteredLocations.length > 0 ) {

                        newProgram.visitedLocations = filteredLocations;
                        result.push( newProgram );
                    }
                    return true;

                }, [] )

                // send the programs to show to the infoWindow
                this.$refs.infoWindow.toggle( programs, idx );
            },

            showProgramInfoWindow( program ) {

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

                OutreachProgram.index( this.allFilters, ( programs ) => this.programs = programs );
            }
        },
        created() {

            this.fieldsDef = Search.form();

            VueGoogleMaps.loaded.then( () => {

                console.log('Map Library Loaded');

                window.addEventListener('resize', _.debounce( this.extendBounds, 500, {}, false ) );

                this.getLocations();
            });

        }
    }

</script>

<style lang="scss" scoped>

    .search-container{

        position: relative;
        width: 100%;
        padding-top: 35%;

        .wrap {

            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;

            margin: 0;
        }

        .filters-container{

            background-color: #efefef;
            padding: 1.5rem 0.5rem 0.5rem;
            overflow: hidden;
            display: flex;
            flex-direction: column;

            .search-type-tabs{

                font-size: 0.8rem;

                ul{

                    display: flex;

                    li{
                        flex: 1;
                    }
                }
            }

            .results-container{

                overflow-y: scroll;
                flex: 1;

                .table{

                    font-size: 0.8rem;
                }
            }
        }

        .map-container{

            flex: 3;
            position: relative;

            .map {

                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
            }
        }


    }

    @media only screen and ( max-width: 768px ) {

        .search-container {

            padding-top: 0;

            .wrap {

                position: static;
                top: auto;
                left: auto;
                bottom: auto;
                right: auto;

                flex-direction: column;
            }

            .filters-container{

                flex: initial;
            }

            .map-container{

                flex: 1;
                min-height: 250px;
            }

            .results-container{

                flex: initial;
            }
        }
    }



</style>