<template>
    <div class="survey-container">

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

                <div class="columns">

                    <div class="column">

                        <select-field
                            v-model="usesEmr"
                            :def="fieldsDef.uses_emr"
                        ></select-field>

                    </div>
                    <div class="column">

                        <text-field
                                v-model="yearInitiated"
                                :def="fieldsDef.year_initiated"
                        ></text-field>

                    </div>

                </div>

                <text-field
                        v-model="yearlyOutreachParticipants"
                        :def="fieldsDef.yearly_outreach_participants"
                ></text-field>

                <text-field
                        v-model="matriculantsPerClass"
                        :def="fieldsDef.matriculants_per_class"
                ></text-field>

                <text-field
                        v-model="monthsOfTravel"
                        :def="fieldsDef.months_of_travel"
                ></text-field>

                <multi-select-field
                        v-model="schoolClasses"
                        :def="fieldsDef.school_classes"
                ></multi-select-field>


            </div>

            <div class="column is-6">

                <textarea-field
                        v-for="additionalDef in fieldsDef.additional_fields"
                        :key="additionalDef.name"
                        v-model="additionalFields[ additionalDef.name ]"
                        :def="additionalDef"
                ></textarea-field>

            </div>

            <div class="column is-12">

                <locations
                        v-model="visitedLocations"
                        :def="fieldsDef.visited_locations">
                </locations>

            </div>

            <div class="column is-12">

                <partners
                        v-model="partners"
                        :def="fieldsDef.partners">
                </partners>

            </div>

            <div class="column is-12">

                <contacts
                        v-model="contacts"
                        :def="fieldsDef.contacts">
                </contacts>

            </div>

            <div class="column is-12">

                <papers
                        v-model="papers"
                        :def="fieldsDef.papers">
                </papers>

            </div>

            <button
                :class="{ button:true, 'is-primary':true, 'is-loading': isSubmitting }"
                @click="saveSurvey()"
            >
                Submit
            </button>

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

    import Survey from '../services/Survey';

    import Contact from '../models/Contact';
    import Partner from '../models/Partner';
    import Location from '../models/Location';
    import Paper from '../models/Paper';

    import FormField from '../models/FormField';
    import Contacts from './survey/Contacts';
    import Locations from './survey/Locations';
    import Papers from './survey/Papers';
    import Partners from './survey/Partners';

    export default {

        props: {

            program_id: {

                type: Number,
                default: undefined
            }
        },

        components: {

            'contacts': Contacts,
            'locations': Locations,
            'papers': Papers,
            'partners': Partners
        },

        data() {

            return {

                // TODO -- use this fields as an update/new flag
                id: '',

                schoolName: '',
                programName: '',
                usesEmr: '',
                yearInitiated: '',
                yearlyOutreachParticipants: '',
                monthsOfTravel: '',
                matriculantsPerClass: '',
                schoolClasses: [],
                additionalFields: {},

                visitedLocations: [],
                partners: [],
                contacts: [],
                papers: [],

                isSubmitting: false,
                fieldsDef: {}
            }
        },

        computed: {

            fieldsDefIsLoaded() {

                return ! _.isEmpty( this.fieldsDef );
            }
        },

        methods: {

            saveSurvey(){

                let fields = {

                    school_name: this.schoolName,
                    name: this.programName,
                    uses_emr: ( this.usesEmr === 'yes' ),
                    year_initiated: this.yearInitiated,
                    yearly_outreach_participants: this.yearlyOutreachParticipants,
                    months_of_travel: this.monthsOfTravel,
                    matriculants_per_class: this.matriculantsPerClass,
                    school_classes: this.schoolClasses,
                    additional_fields: this.additionalFields,

                    // TODO - don't add empty nested fields
                    locations: this.locations,
                    partners: this.partners,
                    contacts: this.contacts,
                    papers: this.papers
                };

                console.log( fields );

                Survey.save( fields, ( result ) => {

                    console.log( result );
                } );
            },

            updateSurvey() {

                // TODO -- implement update
            }
        },

        created(){

            // TODO -- handle both new surveys and updating existing surveys

            Survey.initialize( ( def ) => this.fieldsDef = def );

            if( this.program_id !== undefined ) {

                //Survey.get(this.program_id, ( program ) => this.populateFromProgram( program ) );
                Survey.get( this.program_id, ( program ) => {

                    console.log( program );

                    this.programName = program.name;
                    this.schoolName = program.schoolName;
                    this.usesEmr = ( program.usesEmr ) ? 'yes' : 'no';
                    this.yearInitiated = program.yearInitiated;
                    this.yearlyOutreachParticipants = program.yearlyOutreachParticipants;
                    this.monthsOfTravel = program.monthsOfTravel;
                    this.matriculantsPerClass = program.matriculantsPerClass;
                    this.schoolClasses = program.schoolClasses;
                    this.additionalFields = program.additionalFields;

                    this.partners = program.partners;
                    this.contacts = program.contacts;
                    this.papers = program.papers;
                    this.visitedLocations = program.visitedLocations;
                } );
            }
        }
    }

</script>

<style scoped>

    .loading{

        margin: 40px 0;

        font-size: 1.3rem;
        line-height: 36px;

        .is-loading{

            margin-right: 15px;
        }
    }

</style>
