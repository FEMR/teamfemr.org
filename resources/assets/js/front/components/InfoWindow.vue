<template>
    <gmap-info-window
            :options="options"
            :position="position"
            :opened="opened"
            @closeclick="opened=false"
    >

        <div :class="{ 'map-info-window': true, 'has-multiple': outreachPrograms.length > 1 }">

            <div class="location" v-for="program in outreachPrograms">

                <p
                    class="name"
                    @click="showProgram( program )"
                >

                    <span
                        class="icon is-small"
                        v-if="outreachPrograms.length > 1"
                    >
                      <i :class="{ fa: true, 'fa-plus-square': !program.isVisible, 'fa-minus-square': program.isVisible }"></i>
                    </span>

                    <a :href="program.programPageUrl()">
                        {{ program.name }}
                    </a>
                </p>

                <div class="program-info" v-if="outreachPrograms.length === 1 || program.isVisible">

                    <p class="city_state_country">
                        <span>{{ program.location.city_state_country }}</span>
                    </p>
                    <p v-if="program.datesOfTravel.length"><strong>Dates of travel:</strong> {{ program.datesOfTravel }}</p>
                    <p v-if="program.schoolClasses.length"><strong>Class Involvement:</strong> {{ program.schoolClasses.join( ', ' ) }}</p>
                    <p v-if="program.partners.length"><strong>Partners:</strong> {{ program.partners.join( ', ' ) }}</p>

                    <p>
                        <a :href="program.programPageUrl()" class="button femr-button">
                            More Info &raquo;
                        </a>
                    </p>

                </div>
             </div>
        </div>

    </gmap-info-window>
</template>

<script type="text/babel">

    import OutreachProgram from '../models/OutreachProgram';

    export default {

        data() {

            return {

                // multiple programs can have a pin in the same location
                outreachPrograms: [],

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


        },
        created(){

        },
        methods: {

            /**
             *
             *
             */
            toggle( locations, clicked_index ) {

                this.outreachPrograms = [];

                _.forEach( locations, ( location ) => {

                    // TODO -- keep the outreachProgram objects cached in memory? -- is it worth it?
                    let outreachProgram = new OutreachProgram();
                    outreachProgram.populateFromLocation(location);
                    console.log( outreachProgram );

                    this.outreachPrograms.push( outreachProgram );
                });

                let firstLocation = locations[0];

                // If the current marker is clicked, toggle the window
                if( this.marker_index === clicked_index ) {

                    this.opened = ! this.opened;
                }
                // Different marker clicked
                else {

                    this.opened = false;
                    this.position = { lat: firstLocation.latitude, lng: firstLocation.longitude };
                    this.marker_index = clicked_index;

                    // Opening the info window is how gmaps pulls the window into view.
                    // The delay is being used to trigger this. Maybe there is a better way?
                    setTimeout(() => { this.opened = true; }, 10);
                }
            },

            /**
             *
             * @param program
             */
            showProgram( program ) {

                // toggle if already open
                if( program.isVisible ){

                    program.isVisible = false;
                    return;
                }

                // Close other open programs
                _.forEach( this.outreachPrograms, ( p ) => {

                    p.isVisible = false;
                });

                // open the chosen program
                program.isVisible = true;

                console.log( program );
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

    .map-info-window.has-multiple{

        max-width: 350px;
    }

    .map-info-window.has-multiple .location{

        padding: 5px;
        border: 1px solid #cccccc;
        background-color: #efefef;

        margin-bottom: 3px;
    }

    .map-info-window.has-multiple .name{

        font-size: .9rem;
        margin-bottom: 0;
        background-color: #efefef;

        cursor: pointer;

        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .map-info-window.has-multiple .name .icon{

        margin: 0 20px 0 10px;
    }


    .map-info-window.has-multiple .city_state_country{

        margin-top: 15px;
    }

</style>