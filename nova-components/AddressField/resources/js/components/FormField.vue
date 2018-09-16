<template>
    <default-field :field="field">
        <template slot="field">
            <gmap-autocomplete
                :id="field.name"
                class="w-full form-control form-input form-input-bordered"
                :class="errorClasses"
                :placeholder="field.name"
                v-model="value"
                @place_changed="placeUpdated"
                @keyup.enter.prevent>
            </gmap-autocomplete>
            <p v-if="hasError" class="my-2 text-danger">
                {{ firstError }}
            </p>
        </template>
    </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'

export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],

    methods: {

        placeUpdated( place ) {

            // do nothing is place does not have an address
            if( ! _.has( place, [ 'geometry', 'location' ] ) ) return;

            var components = {};
            for (var i = 0; i < place.address_components.length; i++) {

                var c = place.address_components[i];
                components[c.types[0]] = c;
            }

            // Reset fields so previous info is not left behind
            this.reset();

            let address = '';
            if ( _.has( components, 'street_number' ) ) {
                address += components.street_number.long_name + ' '
            }
            if ( _.has( components, 'route' ) ){
                address += components.route.long_name
            }
            Nova.$emit(this.field.address + '-value', address)

            if ( _.has( components, 'subpremise' ) ){
                Nova.$emit(this.field.address_ext + '-value', components.subpremise.long_name)
            }

            if ( _.has( components, 'locality' ) ){
                Nova.$emit(this.field.locality + '-value', components.locality.long_name)
            }

            if ( _.has( components, 'administrative_area_level_1' ) ){
                Nova.$emit(this.field.administrative_area_level_1 + '-value', components.administrative_area_level_1.short_name)
            }

            if ( _.has( components, 'postal_code' ) ){
                Nova.$emit(this.field.postal_code + '-value', components.postal_code.long_name.short_name)
            }

            if ( _.has( components, 'country' ) ){
                Nova.$emit(this.field.country + '-value', components.country.long_name)
            }

            if ( _.has( place, [ 'geometry', 'location' ] ) ){
                const latitude = parseFloat( place.geometry.location.lat().toFixed( 5 ) );
                const longitude = parseFloat( place.geometry.location.lng().toFixed( 5 ) );
                Nova.$emit(this.field.latitude + '-value', latitude)
                Nova.$emit(this.field.longitude + '-value', longitude)
            }
        },

        reset(){
            Nova.$emit(this.field.address + '-value', '')
            Nova.$emit(this.field.address_ext + '-value', '')
            Nova.$emit(this.field.locality + '-value', '')
            Nova.$emit(this.field.administrative_area_level_1 + '-value', '')
            Nova.$emit(this.field.administrative_area_level_2 + '-value', '')
            Nova.$emit(this.field.postal_code + '-value', '')
            Nova.$emit(this.field.country + '-value', '')
            Nova.$emit(this.field.latitude + '-value', '')
            Nova.$emit(this.field.longitude + '-value', '')
        },

    },
}
</script>
