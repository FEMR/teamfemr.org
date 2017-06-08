import EventBus from "../../event-bus";
import ContactService from "../../services/contact.service.js";

export default {

    template:'#contacts-table-template',
    props: [ 'schoolId', 'programId' ],
    data(){

        return {

            contacts: []
        }
    },
    methods : {

        getContacts(){

            ContactService.index( this.programId )
                .then( ( response ) => {

                    this.contacts = response.data;
                })
                .catch( ( error ) => { console.log(error); });
        },
        editContact( contact ){

            EventBus.$emit( "contacts.editForm", contact );
        },
        destroyContact( contact ){

            console.log( contact );

            var shouldDelete = confirm( "Are you sure you want to delete: " + contact.first_name + " " + contact.last_name );
            if( shouldDelete ) {

                ContactService.destroy( this.programId, contact.id )
                    .then((response) => {

                        this.getContacts();
                    })
                    .catch((error) => { console.log(error); });
            }
        },
        newContact(){

            EventBus.$emit( "contacts.newForm" );
        }
    },
    mounted() {

        this.getContacts();

        EventBus.$on( "contacts.closeForm", () => {

            this.getContacts();
        });
    }
}