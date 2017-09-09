<template>
    <div>

        <div v-if="fieldsDefIsLoaded" class="columns is-multiline">

            <div class="column is-6">

                <text-field
                    v-model="schoolName"
                    :def="fieldsDef.school_name"
                ></text-field>
                <text-field
                    v-model="programName"
                    :def="fieldsDef.program_name"
                ></text-field>
                <select-field
                    v-model="usesEmr"
                    :def="fieldsDef.uses_emr"
                ></select-field>

                <textarea-field
                    v-model="otherSchools"
                    :def="fieldsDef.other_schools"
                ></textarea-field>

            </div>

            <div class="column is-12">

                <contacts :def="fieldsDef.contacts"></contacts>

            </div>

        </div>

        <div v-else>

                <p class="loading">
                    <span class="button is-text is-loading"></span>
                    Building Form...
                </p>

        </div>

    </div>
</template>

<script type="text/babel">

    import FormField from '../models/FormField';
    import Contacts from './survey/Contacts';

    export default {

        components: {

            'contacts': Contacts
        },

        data() {

            return {

                schoolName: '',
                programName: '',
                usesEmr: '',
                otherSchools: '',

                fieldsDef: {}
            }
        },

        computed: {

            fieldsDefIsLoaded() {

                return ! _.isEmpty( this.fieldsDef );
            }
        },

        methods: {

        },

        created(){

            axios.get( '/api/survey/form' )
                .then( ( response ) => {

                    let def = {};
                    _.forEach( response.data.data, ( fieldJson, key ) => {

                        console.log( fieldJson );

                        if( _.isArray( fieldJson ) ) {

                            let subfield = {};
                            _.forEach( fieldJson, ( json ) => {

                                let field = new FormField( json );
                                subfield[ field.name ] = field;
                            });

                            def[ key ] = subfield;
                        }
                        else {

                            def[ key ] = new FormField( fieldJson );
                        }


                    } );

                    this.fieldsDef = def;
                });

        }
    }

</script>

<style scoped>

    .loading{

        margin: 40px 0;

        font-size: 1.3rem;
        line-height: 36px;
    }

    .loading .is-loading{

        margin-right: 15px;
    }
</style>