import EventBus from "../../event-bus";
import LocationService from "../../services/location.service.js";
import Errors from "../../errors.js";

export default {

    template:'#locations-form-template',
    props: [ 'programId' ],
    data (){

        return {

            isLoading: false,
            isVisible: false,
            errors: new Errors(),

            id: '',
            address: '',
            address_ext: '',
            locality: '',
            administrative_area_level_1: '',
            administrative_area_level_2: '',
            postal_code: '',
            country: '',
            latitude: '',
            longitude: '',
            start_date: '',
            end_date: ''
        }
    },
    methods : {

        saveLocation() {

            this.isLoading = true;

            // Create
            if( this.id == '' ) {

                // TODO - fix this monstrosity
                LocationService.create( this.programId, this.address, this.address_ext, this.locality, this.administrative_area_level_1, this.administrative_area_level_2, this.postal_code, this.country, this.latitude, this.longitude, this.start_date, this.end_date )
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
                LocationService.update( this.programId, this.id, this.address, this.address_ext, this.locality, this.administrative_area_level_1, this.administrative_area_level_2, this.postal_code, this.country, this.latitude, this.longitude, this.start_date, this.end_date )
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
        }

    },
    mounted() {

        EventBus.$on( "locations.editForm", ( newLocation ) => {

            this.id = newLocation.id;
            this.address = newLocation.address;
            this.address_ext = newLocation.address_ext;
            this.locality = newLocation.locality;
            this.administrative_area_level_1 = newLocation.administrative_area_level_1;
            this.administrative_area_level_2 = newLocation.administrative_area_level_2;
            this.postal_code = newLocation.postal_code;
            this.country = newLocation.country;
            this.latitude = newLocation.latitude;
            this.longitude = newLocation.longitude;
            this.start_date = newLocation.start_date;
            this.end_date = newLocation.end_date;

            this.showForm();
        });

        EventBus.$on( "locations.newForm", () => {

            this.id = '';
            this.address = '';
            this.address_ext = '';
            this.locality = '';
            this.administrative_area_level_1 = '';
            this.administrative_area_level_2 = '';
            this.postal_code = '';
            this.country = '';
            this.latitude = '';
            this.longitude = '';
            this.start_date = '';
            this.end_date = '';

            this.showForm();
        });
    }
}