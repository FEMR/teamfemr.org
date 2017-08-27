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
            <p class="city_state_country">
                <span>{{ outreachProgram.location.city_state_country }}</span>
            </p>
            <p v-if="outreachProgram.datesOfTravel.length"><strong>Dates of travel:</strong> {{ outreachProgram.datesOfTravel }}</p>
            <p v-if="outreachProgram.schoolClasses.length"><strong>Class Involvement:</strong> {{ outreachProgram.schoolClasses.join( ', ' ) }}</p>
            <p v-if="outreachProgram.partners.length"><strong>Partners:</strong> {{ outreachProgram.partners.join( ', ' ) }}</p>
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

            // TODO -- move this to the model
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
                this.outreachProgram.populateFromLocation(location);
                console.log( this.outreachProgram );

                // If the current marker is clicked, toggle the window
                if( this.marker_index === clicked_index ) {

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

        font-size: 0.9rem;
        margin-bottom: 5px;
    }

    .map-info-window p strong{

        font-weight: normal;
    }

    .map-info-window .city_state_country{

        font-size: 1rem;
        margin-bottom: 15px;
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