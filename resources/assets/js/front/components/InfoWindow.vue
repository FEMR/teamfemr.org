<template>
    <gmap-info-window
            :options="options"
            :position="position"
            :opened="opened"
            @closeclick="opened=false"
    >

        <div class="map-info-window">
            <p class="name">
                <a :href="programPageUrl">
                    {{ outreachProgram.name }}
                </a>
            </p>
            <p>
                <strong>Location: </strong>
                <span class="city" v-if="outreachProgram.location.city">{{ outreachProgram.location.city }}</span>
                <span class="state" v-if="outreachProgram.location.state">{{ outreachProgram.location.state }}</span>
                <span class="sep" v-if="outreachProgram.location.state && outreachProgram.location.country">,</span>
                <span class="country" v-if="outreachProgram.location.country">{{ outreachProgram.location.country }}</span>
            </p>
            <p><strong>Yearly Participants:</strong> {{ outreachProgram.yearlyOutreachParticipants }}</p>
            <p><strong>Matriculants/Class:</strong> {{ outreachProgram.matriculantsPerClass }}</p>
            <p><strong>Year Initiated:</strong> {{ outreachProgram.yearInitiated }}</p>
            <p>
                <a :href="programPageUrl" class="button femr-button">
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

                outreachProgram: new OutreachProgram(),

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
        computed: {

            programPageUrl() {

                if( this.outreachProgram ) {

                    return '/programs/' + this.outreachProgram.slug;
                }
                else return '#';
            }
        },
        created(){

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

    .map-info-window{

        max-width: 350px;
    }

    .map-info-window p{

        margin-bottom: 5px;
    }

    .map-info-window p strong{

        font-weight: normal;
    }

    .map-info-window .name{

        max-width: 300px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #2f2f2f;
        font-size: 1.1rem;
        line-height: 1.3;
    }

</style>