<template>
    <gmap-info-window
            :options="options"
            :position="position"
            :opened="opened"
            @closeclick="opened=false"
    >

        <div :class="{ 'map-info-window': true, 'has-multiple': outreachPrograms.length > 1 }">

            <div
                class="program-nav"
                v-if="outreachPrograms.length > 1 && navIsVisible"
            >
                <a
                    href="#"
                    class="name"
                    v-for="program in outreachPrograms"
                    @click.prevent="showProgram( program )"
                >
                    {{ program.name }} &raquo;
                </a>
            </div>

            <div
                class="location"
                v-if="outreachPrograms.length === 1 || program.isVisible"
                v-for="program in outreachPrograms"
            >

                <a
                    href="#"
                    class="back-button"
                    @click.prevent="showNav()"
                    v-if="outreachPrograms.length > 1"
                >&laquo; Back</a>

                <p class="name">
                    <a :href="program.programPageUrl()">
                        {{ program.name }}
                        <span v-if="program.schoolName.length > 0">
                            <br /> - {{ program.schoolName }}
                        </span>
                    </a>
                </p>

                <p class="city_state_country">
                    <span>{{ program.firstLocationCityStateCountry() }}</span>
                </p>
                <p><strong>Dates of travel:</strong> {{ ( program.monthsOfTravel.length > 0 ) ? program.monthsOfTravel : '--' }}</p>
                <p><strong>Class Involvement:</strong> {{ ( program.schoolClasses.length > 0 ) ? program.schoolClassesList() : '--' }}</p>
                <p><strong>NGO/In Country Partners:</strong> {{ ( program.partners.length > 0 ) ? program.partnersList() : '--' }}</p>

                <p>
                    <a :href="program.programPageUrl()" class="button femr-button">
                        More Info &raquo;
                    </a>
                </p>

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

                navIsVisible: true,

                // TODO - move this to a prop
                opened: false,
                content: '',
                position: {
                    lat: 0,
                    lng: 0
                },
                markerIndex: null,

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

        methods: {

            toggle( programs, clickedIndex ) {

                this.outreachPrograms = [];
                _.forEach( programs, ( program ) => {

                    this.outreachPrograms.push( program );
                });

                // make sure the nav is visible from prior states
                if( this.outreachPrograms.length > 1 ) {

                    this.navIsVisible = true;
                }

                // If the current marker is clicked, toggle the window
                if( this.markerIndex === clickedIndex ) {

                    this.opened = ! this.opened;
                }
                // Different marker clicked
                else {

                    let firstLocation = _.first( _.get( _.first( this.outreachPrograms ), 'visitedLocations' ) );

                    if( firstLocation !== undefined ) {

                        this.opened = false;
                        this.position = {lat: firstLocation.latitude, lng: firstLocation.longitude};
                        this.markerIndex = clickedIndex;

                        // Opening the info window is how gmaps pulls the window into view.
                        // The delay is being used to trigger this. Maybe there is a better way?
                        setTimeout(() => {
                            this.opened = true;
                        }, 10);
                    }
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
                    this.navIsVisible = true;
                    return;
                }

                // Close other open programs
                _.forEach( this.outreachPrograms, ( p ) => {

                    p.isVisible = false;
                });

                // open the chosen program
                program.isVisible = true;
                this.navIsVisible = false;
            },

            showNav(){

                // Close other open programs
                _.forEach( this.outreachPrograms, ( p ) => {

                    p.isVisible = false;
                });
                this.navIsVisible = true;
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
        color: #a1060f;
        font-size: 1.1rem;
        line-height: 1.3;
    }

    .map-info-window .program-nav{

        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: flex-start;
    }

    .map-info-window .program-nav a{

        cursor: pointer;
        font-size: .9rem;
        margin: 10px 0;
    }

    .map-info-window.has-multiple{

    }

    .map-info-window.has-multiple .back-button{

        display: block;
        margin: 15px 0;
        color: #3f3f3f;
        font-size: 1rem;
    }

</style>