<template>
    <gmap-info-window
            :options="options"
            :position="position"
            :opened="opened"
            @closeclick="opened=false"
    >

        <div class="map-info-window">
            <p>{{ outreachProgram.name }}</p>
            <p v-if="outreachProgram.school.name"><strong>School:</strong> {{ outreachProgram.school.name }}</p>
            <p>
                <strong>Location: </strong>
                <span class="state" v-if="outreachProgram.location.state">{{ outreachProgram.location.state }}</span>
                <span class="sep" v-if="outreachProgram.location.state && outreachProgram.location.country">,</span>
                <span class="country" v-if="outreachProgram.location.country">{{ outreachProgram.location.country }}</span>
            </p>
            <p>
                <a :href="'/programs/' + outreachProgram.slug" class="button femr-button" target="_blank">
                    More Info &raquo;
                </a>
            </p>
        </div>

    </gmap-info-window>
</template>

<script type="text/babel">

    import OutreachProgram from '../models/OutreachProgram';

    export default {

        data() {

            return {

                outreachProgram: {},

                opened: false,
                content: '',
                position: {
                    lat: 0,
                    lng: 0
                },
                marker_index: null,

                // InfoWindow Options
                // https://developers.google.com/maps/documentation/javascript/reference#InfoWindowOptions
                options: {

                    pixelOffset: {

                        width: 0,
                        height: -35
                    }
                }
            }
        },
        created(){

            this.outreachProgram = new OutreachProgram();
        },
        methods: {

            toggle( location, clicked_index ) {

                // TODO -- keep the outreachProgram objects cached in memory? -- is it worth it?

                this.outreachProgram.populateFromLocation( location );

                // If the current marker is clicked, toggle the window
                if( this.marker_index == clicked_index ) {

                    this.opened = ! this.opened;
                }
                // Different marker clicked
                else {

                    this.opened = false;
                    this.position = { lat: location.latitude, lng: location.longitude };
                    this.marker_index = clicked_index;

                    // Opening the info window is how gmaps pulls the window into view.
                    // The delay is being used to trigger this. Maybe there is a better way?
                    setTimeout(() => { this.opened = true; }, 10);
                }
            }
        }
    }

</script>

<style scoped>

    .femr-button{

        margin: 10px auto;
        font-size: 0.8rem;
    }


</style>