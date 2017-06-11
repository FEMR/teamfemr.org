<template>
    <div class="femr-map">

        <div class="field">
            <label class="label">Autofill Address</label>
            <p class="control">

                <gmap-autocomplete
                        class="input"
                        placeholder="Enter your address"
                        :value="description"
                        @place_changed="setPlace"
                        @keyup.enter.prevent>
                </gmap-autocomplete>

            </p>
        </div>
        <gmap-map
                ref="gmap"
                :center="center"
                :zoom="zoom"
                :options="{ scrollwheel: false }"
                class="map">
            <gmap-marker
                    :key="index"
                    v-for="(m, index) in markers"
                    :position="m.position"
                    :clickable="true"
                    :draggable="true"
                    @click="center=m.position">
            </gmap-marker>
        </gmap-map>

    </div>
</template>

<script type="text/babel">

    import * as VueGoogleMaps from 'vue2-google-maps';
    import Vue from 'vue';
    import EventBus from "../event-bus"

    Vue.use( VueGoogleMaps, {
        load: {
            key: FEMR.googleMapsKey,
            libraries: 'places'
        }
    });

    export default {

        data() {

            return {

                center: { lat: 0.0, lng: 0.0 },
                zoom: 14,
                bounds: {},
                scrollwheel: false,
                description: '',
                markers: []
            }
        },
        methods: {

            resetMap(){

                this.markers = [];
                this.description = ' ';

                this.center = new google.maps.LatLng( 0.00, 0.00 );
                this.zoom = 1;
            },
            addLocation( latitude, longitude ) {

                let latLng = new google.maps.LatLng( latitude, longitude );

                this.markers = [{ position: latLng }];

                this.center = latLng;
                this.zoom = 14;

                // TODO - this should component probably work with more than one marker -- fix this when needed
//                this.markers.push(
//                        {
//                            position: latLng
//                        }
//                );

//                this.bounds.extend( latLng );
//                this.$refs.gmap.fitBounds( this.bounds );
            },
            setPlace( place ) {

                this.addLocation( place.geometry.location.lat(), place.geometry.location.lng() );

                // Fire event for other components to hook onto
                EventBus.$emit( 'femr_map.address_updated', place );
            }
        },
        mounted() {

            EventBus.$on( 'femr_map.add_marker', ( latitude, longitude ) => {

                this.addLocation( latitude, longitude );
            } );

            EventBus.$on( "locations.closeForm", () => {

                this.resetMap();
            });
        }
    }

</script>

<style scoped>

    .femr-map{

        background-color: #efefef;
        border: 1px solid #cccccc;
        padding: 15px;
    }

    .femr-map .map{

        width: 100%;
        height: 300px;
    }

</style>