import EventBus from "../../event-bus"

/*

    TODO

    - Error Checking
    - How to update the parent table? Refresh ajax call on close?

 */


export default {

    template:'#papers-form-template',
    props: [ 'programId' ],
    data (){

        return {

            isLoading: false,
            isVisible: false,

            id: '',
            title: '',
            url: '',
            description: ''
        }
    },
    methods : {

        savePaper() {

            this.isLoading = true;

            // Create
            if( this.id == '' ) {



                    // TODO - move to service
                    axios.post('/admin/programs/' + this.programId + '/papers', {

                        title: this.title,
                        url: this.url,
                        description: this.description
                    })
                        .then((response) => {

                            this.isLoading = false;
                            this.hideForm();

                            console.log(response);
                        })
                        .catch((error) => {

                            this.isLoading = false;
                            console.log(error);
                        });
            }

            // Edit
            else {
                // TODO - move to service
                axios.put('/admin/programs/' + this.programId + '/papers/' + this.id, {

                        title: this.title,
                        url: this.url,
                        description: this.description
                    })
                    .then((response) => {


                        this.isLoading = false;
                        this.hideForm();

                        console.log(response);
                    })
                    .catch((error) => {

                        this.isLoading = false;
                        console.log(error);
                    });
            }

        },
        destroyPaper(){

            // TODO - move to service
            axios.delete( '/admin/programs/' + this.programId + '/papers/' + this.id )
                .then( ( response ) => {

                    this.isLoading = false;
                    this.hideForm();

                    console.log(response);
                })
                .catch( ( error ) => {

                    this.isLoading = false;
                    console.log(error);
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

            EventBus.$emit( "papers.closeForm" );
        }

    },
    mounted() {

        EventBus.$on( "papers.editForm", ( newPaper ) => {

            this.id = newPaper.id;
            this.title = newPaper.title;
            this.url = newPaper.url;
            this.description = newPaper.description;

            this.showForm();
        });

        EventBus.$on( "papers.newForm", () => {

            this.id = '';
            this.title = '';
            this.url = '';
            this.description = '';

            this.showForm();
        });
    }
}