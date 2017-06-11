import EventBus from "../../event-bus";
import LocationService from "../../services/location.service";
import Errors from "../../errors";
import Location from "../../models/location.class";

export default {

    template:'#locations-form-template',
    props: [ 'programId' ],
    data (){

        return {

            isLoading: false,
            isVisible: false,
            errors: new Errors(),
            location: new Location()
        }
    },
    methods : {

        saveLocation() {

            this.isLoading = true;

            // Create
            if( this.id == '' ) {

                // TODO - fix this monstrosity
                LocationService.create( this.programId, this.location )
                    .then( ( response ) => {

                        this.hideForm();
                        console.log(response);
                    })
                    .catch( ( errors ) => {

                        this.errors.record( errors.response.data );
                        this.isLoading = false;
                    });
            }

            // Edit
            else {

                // TODO - fix this monstrosity
                LocationService.update( this.programId, this.location )
                    .then( ( response ) => {

                        this.hideForm();
                        console.log(response);
                    })
                    .catch( ( errors ) => {

                        this.errors.record( errors.response.data );
                        this.isLoading = false;
                    });
            }

        },
        destroyLocation(){

            LocationService.destroy()
                .then( ( response ) => {

                    this.isLoading = false;
                    this.hideForm();
                })
                .catch( ( error ) => {

                    this.errors.record( errors.response.data );
                    this.isLoading = false;
                });
        },
        cancel(){

            this.hideForm();
        },
        showForm(){

            this.isLoading = false;
            this.isVisible = true;
        },
        hideForm(){

            this.isLoading = false;
            this.isVisible = false;

            this.errors.clear();

            EventBus.$emit( "locations.closeForm" );
        },
        getAddressFromPlace( place ) {

            console.log( this.location );

            this.location.populateFromPlace( place );
        }

    },
    computed: {

        locations: () => {

            return [
                {
                    position: {

                        lat: this.location.latitude,
                        lng: this.location.longitude
                    }
                }
            ];
        }
    },
    mounted() {

        EventBus.$on( 'femr_map.address_updated', this.getAddressFromPlace );

        EventBus.$on( "locations.editForm", ( newLocation ) => {

            this.location.populate( newLocation );
            
            this.showForm();

            // Add a marker for this location to the map
            EventBus.$emit( 'femr_map.add_marker', this.location.latitude, this.location.longitude );
        });

        EventBus.$on( "locations.newForm", () => {

            this.location = new Location();

            this.showForm();
        });
    }
}