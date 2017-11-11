<template>
    <section class="section survey-locations">
        <div class="container locations-map-container">

            <h3 class="title">Visited Locations</h3>
            <hr />

            <div class="columns">
                <div class="column is-7 map-column">

                    <p class="control">

                        <gmap-autocomplete
                                ref="autocomplete"
                                v-model="autocompleteValue"
                                class="input"
                                placeholder="Enter at a city and country"
                                @place_changed="addLocation"
                                @keyup.enter.prevent>
                        </gmap-autocomplete>

                    </p>

                    <gmap-map
                            ref="gmap"
                            :center="center"
                            :zoom="zoom"
                            :options="{ scrollwheel: false }"
                            class="map">
                        <gmap-marker
                                :key="index"
                                v-for="(m, index) in locations"
                                v-if="m.hasPosition()"
                                :position="m.position"
                                :clickable="true"
                                :draggable="true"
                                @click="center=m.position">
                        </gmap-marker>
                    </gmap-map>

                </div>
                <div class="column">

                    <div class="form">

                        <table class="table is-striped location-table" v-if="locations.length > 0">
                            <thead>
                                <tr>
                                    <th v-for="field in def">
                                        {{ field.label }}
                                    </th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="( location, idx ) in locations" :key="location.uniqueId" >
                                    <td>
                                        {{ location.locality }}
                                        <!--<input type="hidden" name="def.locality.name" v-model="location.locality" />-->
                                    </td>
                                    <td>
                                        {{ location.administrative_area_level_1 }}
                                        <!--<input type="hidden" name="def.administrative_area_level_1.name" v-model="location.administrative_area_level_1" />-->
                                    </td>
                                    <td>
                                        {{ location.country }}
                                        <!--<input type="hidden" name="def.country.name" v-model="location.country" />-->
                                    </td>
                                    <td>
                                        <a href="#"  class="delete-button" @click.prevent="removeLocation( idx )">
                                            <span class="icon is-small is-danger">
                                              <i class="fa fa-minus-circle"></i>
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div v-else>

                            <p style="text-align: center;">Enter some locations <br /> using the map </p>

                        </div>

                    </div>

                </div>
            </div>

        </div>
    </section>
</template>

<script type="text/babel">

    import * as VueGoogleMaps from 'vue2-google-maps';
    import VisitedLocation from '../../models/VisitedLocation';

    export default {

        model: {

            prop: 'locations',
            event: 'input'
        },

        props: {

            "locations": {

                default: function () { return []; }
            },

            "def": {

                default: function () { return []; }
            }
        },

        data() {

            return {

                autocompleteValue: '',

                center: { lat: 0.0, lng: 0.0 },
                zoom: 2
            }
        },

        watch: {

            locations: function( newLocations ) {

                if( this.locations.length === 0 ) {

                    this.locations.push( new VisitedLocation() );
                }

                this.extendBounds();

                this.$emit( 'input', newLocations );
            }
        },

        methods: {

            editLocation( idx ){

            },

            removeLocation( indexToDelete ){

                Vue.delete( this.locations, indexToDelete );
            },

            addLocation( place ){

                // don't add when no location data
                if( ! _.has( place, [ 'geometry', 'location' ] ) ) return;

                let location = new VisitedLocation();
                location.populateFromPlace( place );

                // Since the locations list will always contain at least a blank item
                //   we need to detect when there is only a single blank item and
                //   replace that blank item with a new populated Location
                if( this.locations.length === 1 && ! this.locations[0].hasPosition() ) {

                    Vue.set( this.locations, 0, location );
                }
                else {

                    this.locations.push( location );
                }

                this.$refs.autocomplete.$el.value = '';

            },

            extendBounds() {

                if( this.locations.length > 1 ) {

                    const bounds = new google.maps.LatLngBounds();
                    _.forEach( this.locations, ( location ) => {

                        bounds.extend( location.position );
                    });
                    this.$refs.gmap.$mapObject.fitBounds( bounds );
                }
                else if( this.locations.length > 0 ) {

                    const location = this.locations[0];
                    if( location.hasPosition( location ) ) {

                        this.center = location.position;
                        this.zoom = 7;
                    }
                    else {

                        // default center
                        this.center = { lat: 0.0, lng: 0.0 };
                        this.zoom = 2
                    }
                }

            },

        },
        created() {

            VueGoogleMaps.loaded.then( () => {

            });

            window.addEventListener('resize', () => {

                this.extendBounds();
            });

        }
    }

</script>

<style scoped>

    .locations-map-container .map {

        width: 100%;
        height: 300px;

        //flex: 1;
    }

    .locations-map-container .form{

        padding: 0;
    }

    @media only screen and ( max-width: 767px ) {

        .locations-map-container .form{

            padding: 20px 0;
        }
    }

    .locations-map-container .input {

        margin-bottom: 5px;
    }

    .location-table th,
    .location-table td{

        width: 100%;
        font-size: 0.9rem;
    }

    .locations-map-container .column{

        padding: 0 5px;
    }

</style>