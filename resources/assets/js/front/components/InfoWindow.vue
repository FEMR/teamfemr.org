<template>
    <gmap-info-window
            :options="infoOptions"
            :position="infoWindowPos"
            :opened="infoWinOpen"
            @closeclick="infoWinOpen=false"
    >

        <div class="map-info-window">
            <p>{{ programName }}</p>
            <p v-if="schoolName"><strong>School:</strong> {{ schoolName }}</p>
            <p>
                <strong>Location: </strong>
                <span class="state" v-if="state">{{ state }}</span>
                <span class="sep" v-if="state && country">,</span>
                <span class="country" v-if="country">{{ country }}</span>
            </p>
            <p>
                <a :href="'/programs/' + slug" class="button femr-button" target="_blank">
                    More Info &raquo;
                </a>
            </p>
        </div>

    </gmap-info-window>
</template>

<script type="text/babel">

    export default {

        data() {

            return {

                // TODO -- name these variables like they weren't copy/pasted from a demo

                programName: '',
                schoolName: '',

                state: '',
                country: '',
                slug: '',

                infoContent: '',
                infoWindowPos: {
                    lat: 0,
                    lng: 0
                },
                infoWinOpen: false,
                currentMidx: null,
                //optional: offset infowindow so it visually sits nicely on top of our marker
                infoOptions: {
                    pixelOffset: {
                        width: 0,
                        height: -35
                    }
                }
            }
        },
        mounted(){


        },
        methods: {

            toggleInfoWindow( location, idx ) {

                // Example Code kinda from:
                // view-source:http://xkjyeah.github.io/vue-google-maps/infowindow.html

                this.programName = location.outreach_program.name;
                this.schoolName = location.outreach_program.school.name;
                this.state = location.administrative_area_level_1;
                this.country = location.country;
                this.slug = location.outreach_program.slug;

                //check if its the same marker that was selected if yes toggle
                if (this.currentMidx == idx) {

                    this.infoWinOpen = !this.infoWinOpen;
                }
                //if different marker set infowindow to open and reset current marker index
                else {

                    this.infoWinOpen = false;
                    this.infoWindowPos = {lat: location.latitude, lng: location.longitude};
                    this.currentMidx = idx;

                    // Opening the window is how gmaps pulls the window into view.
                    // The delay is needed to trigger this. Maybe there is a better way?
                    setTimeout(() => {
                        this.infoWinOpen = true;
                    }, 10);
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