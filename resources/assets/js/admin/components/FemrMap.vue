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

    Vue.use(VueGoogleMaps, {
        load: {
            key: FEMR.googleMapsKey,
            libraries: 'places'
        }
    });

    export default {

        props: [],
        data() {

            return {

                center: { lat: 0.0, lng: 0.0 },
                zoom: 2,
                scrollwheel: false,
                description: '',
                markers: []
            }
        },
        methods: {

            setPlace( place ) {

                this.markers.push(
                    {
                        position: {

                            lat: place.geometry.location.lat(),
                            lng: place.geometry.location.lng()
                        }
                    }
                );

                this.center = { lat: place.geometry.location.lat(), lng: place.geometry.location.lng() };

                // TODO - maybe use bounds here instead
                this.zoom = 14;

                // Fire event for other components to hook onto
                EventBus.$emit( 'address_updated', place );
            }
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