import EventBus from "../../event-bus";
import LocationService from "../../services/location.service.js";

export default {

    template:'#locations-table-template',
    props: [ 'schoolId', 'programId' ],
    data(){

        return {

            locations: []
        }
    },
    methods : {

        getLocations(){

            LocationService.index( this.programId )
                .then( ( response ) => {

                    this.locations = response.data;
                })
                .catch( ( error ) => { console.log(error); });
        },
        editLocation( location ){

            EventBus.$emit( "locations.editForm", location );
        },
        destroyLocation( location ){

            console.log( location );

            var shouldDelete = confirm( "Are you sure you want to delete: " + location.address );
            if( shouldDelete ) {

                LocationService.destroy( this.programId, location.id )
                    .then((response) => {

                        this.getLocations();
                    })
                    .catch((error) => { console.log(error); });
            }
        },
        newLocation(){

            EventBus.$emit( "locations.newForm" );
        }
    },
    mounted() {

        this.getLocations();

        EventBus.$on( "locations.closeForm", () => {

            this.getLocations();
        });
    }
}