<template>
    <div>
        <!--<div class="field is-clearfix">-->
            <!--<a class="button is-success is-pulled-right" @click="showMapModal">-->
                <!--<span class="icon is-small">-->
                  <!--<i class="fa fa-map-o"></i>-->
                <!--</span>-->
                <!--<span>Autofill</span>-->
            <!--</a>-->
        <!--</div>-->

        <div class="field">
            <label class="label">Name</label>
            <p class="control">
                <input v-model="name" name="name" type="text" class="input">
            </p>
        </div>

        <div class="field">
            <label class="label">Address</label>
            <p class="control">
                <input v-model="address" name="address" type="text" class="input">
            </p>
        </div>

        <div class="field">
            <label class="label">Address Ext.</label>
            <p class="control">
                <input v-model="address_ext" name="address_ext" type="text" class="input">
            </p>
        </div>

        <div class="field">
            <label class="label">City (Locality)</label>
            <p class="control">
                <input v-model="locality" name="locality" type="text" class="input">
            </p>
        </div>

        <div class="field">
            <label class="label">State (Ad. Level 1)</label>
            <p class="control">
                <input v-model="administrative_area_level_1" name="administrative_area_level_1" type="text" class="input">
            </p>
        </div>

        <div class="field">
            <label class="label">Country</label>
            <p class="control">
                <input v-model="country" name="country" type="text" class="input">
            </p>
        </div>

        <div class="field">
            <label class="label">Postal Code</label>
            <p class="control">
                <input v-model="postal_code" name="postal_code" type="text" class="input">
            </p>
        </div>

        <div class="field">
            <label class="label">Latitude</label>
            <p class="control">
                <input v-model="latitude" name="latitude" type="text" class="input">
            </p>
        </div>

        <div class="field">
            <label class="label">Longitude</label>
            <p class="control">
                <input v-model="longitude" name="longitude" type="text" class="input">
            </p>
        </div>

        <div class="field">
            <label class="label">Notes</label>
            <p class="control">
                <textarea name="notes" class="textarea" placeholder="Enter optional notes"></textarea>
            </p>
        </div>

        <div class="field is-grouped">
            <p class="control">
                <button class="button is-primary">Submit</button>
            </p>
        </div>
    </div>
</template>



<script type="text/babel">

    import EventBus from "../../event-bus";

    export default {

        props: [],
        data() {

            return {

                name: '',
                address: '',
                address_ext: '',
                locality: '',
                administrative_area_level_1: '',
                country: '',
                postal_code: '',
                latitude: 0.0,
                longitude: 0.0,
                notes: ''
            }
        },
        computed: {
            
        },
        methods: {

            getAddressFromPlace( place ) {

                console.log(place);

                var components = {};
                for (var i = 0; i < place.address_components.length; i++) {

                    var c = place.address_components[i];
                    components[c.types[0]] = c;
                }

                if ( place.hasOwnProperty('name') ) {

                    this.name = place.name;
                }

                if ( components.hasOwnProperty('street_number') ) {

                    this.address = components.street_number.long_name + ' '
                }

                if ( components.hasOwnProperty('route') ){

                    this.address += components.route.long_name;
                }

                if ( components.hasOwnProperty('subpremise') ){

                    this.address_ext = components.subpremise.long_name;
                }

                if ( components.hasOwnProperty('locality') ){

                    this.locality = components.locality.long_name;
                }

                if ( components.hasOwnProperty('administrative_area_level_1') ){

                    this.administrative_area_level_1 = components.administrative_area_level_1.short_name;
                }

                if ( components.hasOwnProperty('postal_code') ){

                    this.postal_code = components.postal_code.long_name;
                }

                if ( components.hasOwnProperty('country') ){

                    this.country = components.country.long_name;
                }

                if ( place.hasOwnProperty('geometry') ){

                    this.latitude = place.geometry.location.lat().toFixed( 5 );
                    this.longitude = place.geometry.location.lng().toFixed( 5 );
                }
            }
        },
        mounted() {

            EventBus.$on( 'femr_map.address_updated', this.getAddressFromPlace );
        }
    }

</script>

<style scoped>



</style>