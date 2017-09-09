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

                <text-field
                        v-model="yearInitiated"
                        :def="fieldsDef.year_initiated"
                ></text-field>

                <text-field
                        v-model="participantsPerYear"
                        :def="fieldsDef.participants_per_year"
                ></text-field>

                <text-field
                        v-model="matriculantsPerClass"
                        :def="fieldsDef.matriculants_per_class"
                ></text-field>

                <text-field
                        v-model="monthsOfTravel"
                        :def="fieldsDef.months_of_travel"
                ></text-field>

                <!--<select-field-->
                        <!--v-model="schoolClasses"-->
                        <!--:def="fieldsDef.school_classes"-->
                <!--&gt;</select-field>-->

                <textarea-field
                        v-for="additionalDef in fieldsDef.additional_fields"
                        :key="additionalDef.name"
                        v-model="additionalFields[ additionalDef.name ]"
                        :def="additionalDef"
                ></textarea-field>

            </div>

            <div class="column is-12">

                <locations :def="fieldsDef.locations"></locations>

            </div>

            <div class="column is-12">

                <partners :def="fieldsDef.partners"></partners>

            </div>

            <div class="column is-12">

                <contacts :def="fieldsDef.contacts"></contacts>

            </div>

            <div class="column is-12">

                <papers :def="fieldsDef.papers"></papers>

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
    import Locations from './survey/Locations';
    import Papers from './survey/Papers';
    import Partners from './survey/Partners';

    export default {

        components: {

            'contacts': Contacts,
            'locations': Locations,
            'papers': Papers,
            'partners': Partners
        },

        data() {

            return {

                schoolName: '',
                programName: '',
                usesEmr: '',
                yearInitiated: '',
                participantsPerYear: '',
                monthsOfTravel: '',
                matriculantsPerClass: '',
                schoolClasses: [],
                additionalFields: {},

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

                    console.log( "Field Def" );
                    console.log( this.fieldsDef )
                });

            ;
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