<template>
    <section class="section survey-locations">
        <div class="container locations-map-container">

            <h3 class="title">Visited Locations</h3>
            <hr />

            <div class="columns">
                <div class="column">

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
                                v-if="hasPosition(m)"
                                :position="m.position"
                                :clickable="true"
                                :draggable="true"
                                @click="center=m.position">
                        </gmap-marker>
                    </gmap-map>

                </div>
                <div class="column">

                    <div class="form">

                        <div class="columns location-row location-headers">

                            <div class="column" v-for="field in def">
                                <label class="label">{{ field.label }}</label>
                            </div>

                            <div class="column button-column">

                            </div>
                        </div>

                        <div v-for="( location, idx ) in locations" :key="location.uniqueId" class="columns location-row">

                            <div class="column">

                                <text-field
                                        v-model="location.locality"
                                        :def="def.locality"
                                        :initialValue="location.locality"
                                ></text-field>

                            </div>

                            <div class="column">

                                <text-field
                                        v-model="location.administrative_area_level_1"
                                        :def="def.administrative_area_level_1"
                                        :initialValue="location.administrative_area_level_1"
                                ></text-field>

                            </div>

                            <div class="column">

                                <text-field
                                        v-model="location.country"
                                        :def="def.country"
                                        :initialValue="location.country"
                                ></text-field>

                            </div>

                            <div class="column button-column">

                                <a href="#"  class="delete-button" @click.prevent="removeLocation( idx )">
                                <span class="icon is-small is-danger">
                                  <i class="fa fa-minus-circle"></i>
                                </span>
                                </a>

                            </div>

                    </div>

                    </div>

                </div>
            </div>

        </div>
    </section>
</template>

<script type="text/babel">

    import * as VueGoogleMaps from 'vue2-google-maps';
    import Location from '../../models/Location';

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

                    this.locations.push( new Location() );
                }

                this.extendBounds();

                this.$emit( 'input', newLocations );
            }
        },

        methods: {

            hasPosition( m ) {

              return ! _.isEmpty( m.position );
            },

            editLocation( idx ){

            },

            removeLocation( indexToDelete ){

                Vue.delete( this.locations, indexToDelete );
            },

            addLocation( place ){

                // don't add when no location data
                if( ! _.has( place, [ 'geometry', 'location' ] ) ) return;

                let location = new Location();
                location.populateFromPlace( place );

                // Since the locations list will always contain at least a blank item
                //   we need to detect when there is only a single blank item and
                //   replace that blank item with a new populated Location
                if( this.locations.length === 1 && _.isEmpty( this.locations[0].position ) )
                {
                    console.log( "Set location 0" );
                    console.log( location );

                    Vue.set( this.locations, 0, location );
                }
                else {

                    this.locations.push( location );
                }

                this.$refs.autocomplete.$el.value = '';

            },

            extendBounds() {

                console.log( "checking bounds" );

                if( this.locations.length > 1 ) {

                    console.log( "Extend Bounds" );
                    const bounds = new google.maps.LatLngBounds();

                    _.forEach( this.locations, ( location ) => {

                        //let latLng = new google.maps.LatLng( location.latitude, location.longitude );
                        bounds.extend( location.position );
                    });

                    this.$refs.gmap.$mapObject.fitBounds( bounds );
                }
                else if( this.locations.length > 0 ) {

                    console.log( "Default Center" );
                    const location = this.locations[0];
                    if( this.hasPosition( location ) ) {

                        this.center = location.position;
                        this.zoom = 7;
                    }
                    else {

                        console.log( "No markers" );

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
    }

    .location-row .button-column {

        width: 25px;
        flex: 0 auto;
    }

    .location-headers .column{

        padding: 0.5rem 0.75rem 0;
        margin-bottom: -0.5rem;
    }

</style>