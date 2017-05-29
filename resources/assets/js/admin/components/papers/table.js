import EventBus from "../../event-bus";
import PaperService from "../../services/paper.service.js";

export default {

    template:'#papers-table-template',
    props: [ 'schoolId', 'programId' ],
    data(){

        return {

            papers: []
        }
    },
    methods : {

        getPapers(){

            PaperService.index( this.programId )
                .then( ( response ) => {

                    this.papers = response.data;
                })
                .catch( ( error ) => {

                    console.log(error);
                });
        },
        editPaper( paper ){

            EventBus.$emit( "papers.editForm", paper );
        },
        destroyPaper( paper ){

            console.log( paper );

            var shouldDelete = confirm( "Are you sure you want to delete: " + paper.title );
            if( shouldDelete ) {

                PaperService.destroy( this.programId, paper.id )
                    .then((response) => {

                        this.getPapers();
                    })
                    .catch((error) => {

                        console.log(error);
                    });
            }
        },
        newPaper(){

            EventBus.$emit( "papers.newForm" );
        }
    },
    mounted() {

        this.getPapers();

        EventBus.$on( "papers.closeForm", () => {

            this.getPapers();
        });
    }
}