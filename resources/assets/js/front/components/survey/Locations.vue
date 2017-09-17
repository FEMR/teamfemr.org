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

                        <div v-for="( location, idx ) in locations" :key="location.id" class="columns location-row">

                            <div class="column">

                                <text-field
                                        v-model="location.city"
                                        :def="def.city"
                                        :initialValue="location.city"
                                ></text-field>

                            </div>

                            <div class="column">

                                <text-field
                                        v-model="location.state"
                                        :def="def.state"
                                        :initialValue="location.state"
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
                bounds: {},
                zoom: 2
            }
        },

        watch: {

            locations: function( newLocations ) {

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

                let location = new Location();
                location.populateFromPlace( place );
                this.locations.push( location );

                this.extendBounds( location.position.lat, location.position.lng );
                this.fitBounds();

                this.$refs.autocomplete.$el.value = '';

            },

            initBounds() {

                this.bounds = new google.maps.LatLngBounds();
            },

            fitBounds() {

                if( ! _.isEmpty( this.bounds ) && this.locations.length > 1 ) {

                    this.$refs.gmap.fitBounds( this.bounds );
                }
                else if( this.locations.length > 0 ) {

                    let location = this.locations[0];
                    this.center = location.position;
                    this.zoom = 7;
                }
            },

            extendBounds( latitude, longitude ) {

                let latLng = new google.maps.LatLng( latitude, longitude );
                this.bounds.extend( latLng );
            },

        },
        created() {

            VueGoogleMaps.loaded.then( () => {

                this.initBounds();
            });

            window.addEventListener('resize', () => {

                this.fitBounds();
            });
        }
    }

</script>

<style lang="scss" scoped>

    .locations-map-container{

        .map {

            width: 100%;
            height: 300px;
        }
    }

    .location-row {

        .button-column {
            width: 25px;
            flex: 0 auto;
        }
    }

    .location-headers{

        .column{

            padding: 0.5rem 0.75rem 0;
            margin-bottom: -0.5rem;
        }
    }

</style>