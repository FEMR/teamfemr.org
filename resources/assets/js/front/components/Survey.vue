<template>
    <div>

        <div class="columns is-multiline">

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

    </div>
</template>

<script type="text/babel">

    import SurveyFields from '../data/survey-fields';
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

        methods: {

        },

        created(){

            _.forEach( SurveyFields.data, ( fieldJson, key ) => {

                if( _.isArray( fieldJson ) ) {

                    let subfield = {};
                    _.forEach( fieldJson, ( json ) => {

                        let field = new FormField( json );
                        subfield[ field.name ] = field;
                    });

                    this.fieldsDef[ key ] = subfield;
                }
                else {

                    this.fieldsDef[ key ] = new FormField( fieldJson );
                }


            } );


            console.log( this.fieldsDef );
        }
    }

</script>

<style scoped>

</style>