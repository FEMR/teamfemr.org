import EventBus from "../../event-bus"

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

            // TODO - move to service
            axios.get( '/admin/programs/' + this.programId + '/papers' )
                .then( ( response ) => {

                    this.papers = response.data;

                    console.log(response);
                })
                .catch( ( error ) => {

                    console.log(error);
                });
        },
        editPaper( paper ){

            EventBus.$emit( "papers.editForm", paper );
        },
        destroyPaper( paper ){

            var shouldDelete = confirm( "Are you sure you want to delete: " + paper.name );
            if( shouldDelete ) {

                // TODO - move to service
                axios.delete('/admin/programs/' + this.programId + '/papers/' + paper.id)
                    .then((response) => {

                        console.log(response);
                    })
                    .catch((error) => {

                        console.log(error);
                    });
            }
            // EventBus.$emit( "papers.destroyForm", paper );
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