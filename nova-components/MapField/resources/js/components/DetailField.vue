<template>
    <panel-item :field="field">
        <template slot="value">
            <gmap-map
                    ref="gmap"
                    :center="position"
                    :zoom="8"
                    :options="{ scrollwheel: false }"
                    class="map">
                <gmap-marker
                        :position="position"
                        :draggable="true">
                </gmap-marker>
            </gmap-map>
        </template>
    </panel-item>
</template>

<script>
    export default {
        props: ['resource', 'resourceName', 'resourceId', 'field'],
        computed: {
            latitude(){
                return this.field.value.lat;
            },
            longitude(){
                return this.field.value.lng;
            },
            position(){

                return { lat: this.latitude, lng: this.longitude };
            }
        }
    }
</script>

<style type="text/css">
    .map {
        width: 100%;
        height: 300px;
    }
</style>
