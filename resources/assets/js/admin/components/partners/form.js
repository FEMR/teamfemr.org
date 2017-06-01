import EventBus from "../../event-bus";
import PartnerService from "../../services/partner.service.js";
import Errors from "../../errors.js";

export default {

    template:'#partners-form-template',
    props: [ 'programId' ],
    data (){

        return {

            isLoading: false,
            isVisible: false,
            errors: new Errors(),

            id: '',
            name: '',
            website: ''
        }
    },
    methods : {

        savePartner() {

            this.isLoading = true;

            // Create
            if( this.id == '' ) {

                PartnerService.create( this.programId, this.name, this.website )
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

                PartnerService.update( this.programId, this.id, this.name, this.website )
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
        destroyPartner(){

            PartnerService.destroy()
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

            EventBus.$emit( "partners.closeForm" );
        }

    },
    mounted() {

        EventBus.$on( "partners.editForm", ( newPartner ) => {

            this.id = newPartner.id;
            this.name = newPartner.name;
            this.website = newPartner.website;

            this.showForm();
        });

        EventBus.$on( "partners.newForm", () => {

            this.id = '';
            this.name = '';
            this.website = '';

            this.showForm();
        });
    }
}