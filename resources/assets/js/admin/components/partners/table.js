import EventBus from "../../event-bus";
import PartnerService from "../../services/partner.service.js";

export default {

    template:'#partners-table-template',
    props: [ 'schoolId', 'programId' ],
    data(){

        return {

            partners: []
        }
    },
    methods : {

        getPartners(){

            PartnerService.index( this.programId )
                .then( ( response ) => {

                    this.partners = response.data;
                })
                .catch( ( error ) => { console.log(error); });
        },
        editPartner( partner ){

            EventBus.$emit( "partners.editForm", partner );
        },
        destroyPartner( partner ){

            console.log( partner );

            var shouldDelete = confirm( "Are you sure you want to delete: " + partner.name );
            if( shouldDelete ) {

                PartnerService.destroy( this.programId, partner.id )
                    .then((response) => {

                        this.getPartners();
                    })
                    .catch((error) => { console.log(error); });
            }
        },
        newPartner(){

            EventBus.$emit( "partners.newForm" );
        }
    },
    mounted() {

        this.getPartners();

        EventBus.$on( "partners.closeForm", () => {

            this.getPartners();
        });
    }
}