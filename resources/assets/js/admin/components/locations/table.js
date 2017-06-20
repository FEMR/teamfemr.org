import EventBus from "../../event-bus";
import LocationService from "../../services/location.service.js";
import Location from "../../models/location.class";

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

                    let locations = [];
                    _.forEach( response.data, function( location_obj ) {

                        let location = new Location();
                        location.populate( location_obj );

                        locations.push( location );
                    });
                    
                    this.locations = locations;
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