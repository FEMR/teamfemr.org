import EventBus from "../../event-bus";
import PaperService from "../../services/paper.service.js";
import Errors from "../../errors.js";

export default {

    template:'#papers-form-template',
    props: [ 'programId' ],
    data (){

        return {

            isLoading: false,
            isVisible: false,
            errors: new Errors(),

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

                PaperService.create( this.programId, this.title, this.url, this.description )
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
                
                PaperService.update( this.programId, this.id, this.title, this.url, this.description )
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
        destroyPaper(){

            PaperService.destroy()
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