import EventBus from "../../event-bus";
import ContactService from "../../services/contact.service.js";
import Errors from "../../errors.js";

export default {

    template:'#contacts-form-template',
    props: [ 'programId' ],
    data (){

        return {

            isLoading: false,
            isVisible: false,
            errors: new Errors(),
            
            id: '',
            prefix: '',
            first_name: '',
            middle_name: '',
            last_name: '',
            suffix: '',
            title: '',
            phone: '',
            email: '',
            notes: ''
        }
    },
    methods : {

        saveContact() {

            this.isLoading = true;

            // Create
            if( this.id == '' ) {

                ContactService.create( this.programId, this.prefix, this.first_name, this.middle_name, this.last_name, this.suffix, this.title, this.phone, this.email, this.notes )
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

                ContactService.update( this.programId, this.id, this.prefix, this.first_name, this.middle_name, this.last_name, this.suffix, this.title, this.phone, this.email, this.notes )
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
        destroyContact(){

            ContactService.destroy()
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

            EventBus.$emit( "contacts.closeForm" );
        }

    },
    mounted() {

        EventBus.$on( "contacts.editForm", ( newContact ) => {

            this.id = newContact.id;
            this.prefix = newContact.prefix;
            this.first_name = newContact.first_name;
            this.middle_name = newContact.middle_name;
            this.last_name = newContact.last_name;
            this.suffix = newContact.suffix;
            this.title = newContact.title;
            this.phone = newContact.phone;
            this.email = newContact.email;
            this.notes = newContact.notes;

            this.showForm();
        });

        EventBus.$on( "contacts.newForm", () => {

            this.id = '';
            this.prefix = '';
            this.first_name = '';
            this.middle_name = '';
            this.last_name = '';
            this.suffix = '';
            this.title = '';
            this.phone = '';
            this.email = '';
            this.notes = '';

            this.showForm();
        });
    }
}