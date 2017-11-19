<template>
    <div class="survey-container">

        <div v-if="fieldsDefIsLoaded">

            <div class="columns questions-container">
                <div id="survey-questions" class="column is-8">
                    <div class="columns is-multiline">

                        <template v-if="showWelcomeMessage && showGuestComplete">

                            <guest-complete></guest-complete>

                        </template>

                        <template v-else>

                            <div class="column is-10"  v-if="showWelcomeMessage">
                                <welcome-message :program-id="programId"></welcome-message>
                            </div>

                            <div class="column is-10 section">

                                <text-field
                                    v-model="schoolName"
                                    class="school_name"
                                    :def="fieldsDef.schoolName"
                                    @input="dataUpdated()"
                                ></text-field>

                                <text-field
                                    v-model="name"
                                    class="name"
                                    :def="fieldsDef.name"
                                    @input="dataUpdated()"
                                ></text-field>

                                <select-field
                                    v-model="usesEmr"
                                    class="uses_emr"
                                    :def="fieldsDef.usesEmr"
                                    @input="dataUpdated()"
                                ></select-field>

                                <text-field
                                    v-model="yearInitiated"
                                    class="year_initiated"
                                    :def="fieldsDef.yearInitiated"
                                    @input="dataUpdated()"
                                ></text-field>

                                <text-field
                                    v-model="yearlyOutreachParticipants"
                                    class="yearly_outreach_participants"
                                    :def="fieldsDef.yearlyOutreachParticipants"
                                    @input="dataUpdated()"
                                ></text-field>

                                <text-field
                                    v-model="matriculantsPerClass"
                                    class="matriclants_per_class"
                                    :def="fieldsDef.matriculantsPerClass"
                                    @input="dataUpdated()"
                                ></text-field>

                                <multi-select-field
                                    v-model="monthsOfTravel"
                                    class="months_of_travel"
                                    :def="fieldsDef.monthsOfTravel"
                                    @input="dataUpdated()"
                                ></multi-select-field>

                                <multi-select-field
                                    v-model="schoolClasses"
                                    class="school_classes"
                                    :def="fieldsDef.schoolClasses"
                                    @input="dataUpdated()"
                                ></multi-select-field>

                            </div>
                            <div class="column is-10 section">
                                <textarea-field
                                        v-for="additionalDef in fieldsDef.additionalFields"
                                        :key="additionalDef.name"
                                        v-model="additionalFields[ additionalDef.name ]"
                                        class="additionalDef.name"
                                        :def="additionalDef"
                                        @input="dataUpdated()"
                                ></textarea-field>
                            </div>
                            <div class="column is-12 custom-section">

                                <locations
                                        v-model="visitedLocations"
                                        class="visited_locations"
                                        :def="fieldsDef.visitedLocations"
                                        @input="dataUpdated()"
                                ></locations>

                                <partners
                                        v-model="partners"
                                        class="partners"
                                        :def="fieldsDef.partners"
                                        @input="dataUpdated()"
                                ></partners>

                                <contacts
                                        v-model="contacts"
                                        class="contacts"
                                        :def="fieldsDef.contacts"
                                        @input="dataUpdated()"
                                ></contacts>

                                <papers
                                        v-model="papers"
                                        class="papers"
                                        :def="fieldsDef.papers"
                                        @input="dataUpdated()"
                                ></papers>

                                <div class="section">

                                    <textarea-field
                                            v-model="comments"
                                            class="comments"
                                            :def="fieldsDef.comments"
                                            @input="dataUpdated()"
                                    ></textarea-field>

                                </div>

                            </div>

                        </template>
                    </div>
                </div>

                <div v-if="windowWidth > 768" class="column is-4" >
                    <!-- TODO - make component -->
                    <div class="status-container" ref="status-container" >
                        <affix
                            class="survey-status"
                            ref="survey-status"
                            :style="{ width: statusWidth }"
                            relative-element-selector="#survey-questions"
                            :offset="{ top: 140, bottom: 40 }"
                            :enabled="windowWidth > 768"
                            v-on:affixtop="statusWidth = 'auto'"
                            v-on:affixtbottom="statusWidth = 'auto'"
                        >

                            <div class="message is-danger" v-if="errors.any()">
                                <div class="message-body">

                                    <ul>
                                        <li v-for="error in errors.all()">{{ error }}</li>
                                    </ul>

                                </div>
                            </div>

                            <p>Completed: {{ completedQuestions }} / {{ totalQuestions }}</p>
                            <progress class="progress is-success" :value="completedQuestions" :max="totalQuestions">{{ parseInt( completedQuestions / totalQuestions ) }}%</progress>

                            <div class="button-container sticky">

                                <button
                                    :class="{ button: true, 'femr-button': true, 'is-loading': isSubmitting }"
                                    @click="saveClicked()"
                                >
                                    <span v-if="Number.isInteger( id )">Save</span>
                                    <span v-else>Submit</span>
                                </button>

                            </div>

                            <p v-if="lastUpdated.length > 0">Last Update: {{ lastUpdated }}</p>

                        </affix>
                    </div>
                </div>


            </div>

            <button
                v-if="windowWidth <= 768"
                :class="{ button:true, 'femr-button': true, 'is-loading': isSubmitting }"
                @click="saveClicked()"
            >
                <span v-if="Number.isInteger( id )">Save</span>
                <span v-else>Submit</span>
            </button>

        </div>

        <div v-else>

            <p class="loading">
                <span class="button is-text is-loading"></span>
                Loading..
            </p>

        </div>

    </div>
</template>

<script type="text/babel">

    import store from 'store';
    import expirePlugin from 'store/plugins/expire';
    store.addPlugin(expirePlugin);

    import OutreachProgram from '../models/OutreachProgram';
    import Survey from '../services/Survey';
    import User from '../services/User';

    import Contacts from './survey/Contacts';
    import Locations from './survey/Locations';
    import Papers from './survey/Papers';
    import Partners from './survey/Partners';
    import GuestComplete from './survey/GuestComplete';
    import WelcomeMessage from './survey/WelcomeMessage';
    import SignUp from './SignUp';
    import Register from './Register';

    const CACHE_KEY = 'FEMR.survey';

    export default {

        props: {

            programId: {

                type: Number,
                default: undefined
            },

            showWelcomeMessage: {

                type: Boolean,
                default: true
            },

            useLocalStorage: {

                type: Boolean,
                default: true
            }
        },

        components: {

            'contacts': Contacts,
            'locations': Locations,
            'papers': Papers,
            'partners': Partners,
            'guest-complete': GuestComplete,
            'welcome-message': WelcomeMessage,

            'sign-up': SignUp,
            'register': Register
        },

        data() {

            return {

                fieldsDef: {},

                id: '',
                schoolName: '',
                name: '',
                usesEmr: '',
                yearInitiated: '',
                yearlyOutreachParticipants: '',
                monthsOfTravel: [],
                matriculantsPerClass: '',
                schoolClasses: [],
                additionalFields: {},
                comments: '',
                lastUpdated: '',

                visitedLocations: [],
                partners: [],
                contacts: [],
                papers: [],

                isSubmitting: false,
                showGuestComplete: false,
                windowWidth: 0,
                statusWidth: 'auto'
            }
        },

        computed: {

            isDesktop: function() {

                return this.windowWidth >= 768;
            },

            // TODO -- implement better
            totalQuestions: function() {

                let total = _.keys( this.fieldsDef ).length - 1;
                total += _.keys( this.fieldsDef['additionalFields'] ).length;

                return total;
            },

            completedQuestions: function() {

                // TODO -- handle additional fields

                if( ! this.fieldsDefIsLoaded ) return 0;

                let count = 0;
                _.forEach( _.keys( this.fieldsDef ), ( key ) => {

                    if( key === 'additionalFields' ) {

                        _.forEach( this.fieldsDef.additionalFields, (field, additionalKey) => {

                            if( ! _.isEmpty( this._data['additionalFields'][ additionalKey ] ) ) {
                                count++;
                            }
                        });
                        return true;
                    }

                    if( _.has( this._data, key ) ){

                        if( _.isArray( this._data[key] ) ) {

                            if( ( this.filterEmptyObjects( this._data[key] ) ).length > 0 )
                            {
                               count++;
                            }
                        }
                        else
                        {
                            if( ! _.isEmpty( this._data[ key ] ) ) {
                               count++;
                            }
                        }

                    }

                });

                return count;
            },

            fieldsDefIsLoaded: function() {

                return ! _.isEmpty( this.fieldsDef );
            },

            postFields: function() {

                return {

                    school_name: this.schoolName,
                    name: this.name,
                    uses_emr: ( this.usesEmr === 'yes' ) ,
                    year_initiated: this.yearInitiated,
                    yearly_outreach_participants: this.yearlyOutreachParticipants,
                    months_of_travel: _.map( this.monthsOfTravel, ( m ) => m.value ),
                    matriculants_per_class: this.matriculantsPerClass,
                    school_classes: _.map( this.schoolClasses, ( c ) => c.value ),
                    additional_fields: this.additionalFields,
                    comments: this.comments,
                    visited_locations: this.filterEmptyObjects( _.map( this.visitedLocations, ( l ) => l.post() ) ),
                    partners: this.filterEmptyObjects( _.map( this.partners, ( p ) => p.post() ) ),
                    contacts: this.filterEmptyObjects( _.map( this.contacts, ( c ) => c.post() ) ),
                    papers: this.filterEmptyObjects( _.map( this.papers, ( p ) => p.post() ) )
                };

            },

            storeFields: function() {

                return {

                    id: this.id,
                    schoolName: this.schoolName,
                    name: this.name,
                    usesEmr: ( this.usesEmr === 'yes' ) ,
                    yearInitiated: this.yearInitiated,
                    yearlyOutreachParticipants: this.yearlyOutreachParticipants,
                    monthsOfTravel: this.monthsOfTravel,
                    matriculantsPerClass: this.matriculantsPerClass,
                    schoolClasses: this.schoolClasses,
                    additionalFields: this.additionalFields,
                    comments: this.comments,
                    lastUpdated: this.lastUpdated,
                    visitedLocations: this.filterEmptyObjects( _.map( this.visitedLocations, ( l ) => l.store() ) ),
                    partners: this.filterEmptyObjects( _.map( this.partners, ( p ) => p.store() ) ),
                    contacts: this.filterEmptyObjects( _.map( this.contacts, ( c ) => c.store() ) ),
                    papers: this.filterEmptyObjects( _.map( this.papers, ( p ) => p.store() ) )
                };
            },

            isLoggedIn: function() {

                return User.isLoggedIn();
            }

        },

        methods: {

            dataUpdated() {

                if( _.isInteger( this.id ) ) {

                    // auto save every 30 seconds when updating?
                    // -- save this for vuex refactor
                    //this.delayedUpdate();
                }
                else{

                    this.updateCache();
                }
            },

            updateCache: _.throttle( function() {

                if( this.useLocalStorage ) {

                    store.set(CACHE_KEY, this.storeFields, Date.now() + 120 * 60 * 1000 /* 2 hours in ms */);
                }

            }, 10000 ),

            // Experimented with this, not currently using
            delayedUpdate: _.throttle( function() {

                this.updateSurvey();

            }, 30000 ),

            setWindowWidth() {

                this.windowWidth = window.innerWidth;
            },

            statusAffixed() {

                if( this.isDesktop ) {

                    let width = this.$refs['status-container'].clientWidth;
                    this.statusWidth = ( width ) ? width + 'px' : 'auto';
                }
            },

            // TODO - move this to its own class/file and write it a little clearer
            filterEmptyObjects( items ) {

                // `uniqueId` will always have a value, so ignore it when checking for all empty fields
                return _.filter( items, ( item ) => _.some( item, ( field, key ) =>  ! _.isEmpty( field ) && key !== 'uniqueId' ) );
            },

            setLocalData( program ) {

                this.id = program.id;
                this.lastUpdated = program.lastUpdated;
                this.name = program.name;
                this.schoolName = program.schoolName;
                this.usesEmr = ( program.usesEmr === true ) ? 'yes' : ( program.usesEmr === false ) ? 'no' : '';
                this.yearInitiated = program.yearInitiated;
                this.yearlyOutreachParticipants = program.yearlyOutreachParticipants;
                this.monthsOfTravel = program.monthsOfTravel;
                this.matriculantsPerClass = program.matriculantsPerClass;
                this.schoolClasses = program.schoolClasses;
                this.additionalFields = program.additionalFields;
                this.comments = program.comments;
                this.partners = program.partners;
                this.contacts = program.contacts;
                this.papers = program.papers;
                this.visitedLocations = program.visitedLocations;
            },

            saveClicked() {

                this.isSubmitting = true;

                // if all fields are valid, then update/create, else show errors
                this.$validator.validateAll( this.postFields ).then( ( result ) => {

                    if( result ) {

                        if( Number.isInteger( this.id ) ) {

                            this.updateSurvey();
                        }
                        else {

                            this.createSurvey();
                        }
                    }
                    else {

                        // trigger validation on the child elements
                        _.forEach( this.errors.collect(), ( error, key ) => this.$emit( 'validate', key ) );
                        this.isSubmitting = false;
                    }

                });

            },

            createSurvey(){

                this.isSubmitting = true;

                Survey.create( this.postFields, ( program ) => {

                    // If logged in, redirect to edit page
                    if( User.isLoggedIn() ) {

                        window.location.href = '/survey/' + program.id;
                    }
                    // If not logged in, show survey set to moderate message
                    else {

                        this.isSubmitting = false;
                        this.showGuestComplete = true;

                        //this.setLocalData( program );
                        store.remove( CACHE_KEY );
                    }

                }, ( error ) => this.isSubmitting = false );
            },

            updateSurvey() {

                if( ! _.isInteger( this.id ) ) return;

                this.isSubmitting = true;

                Survey.update( this.id, this.postFields, ( program ) => {

                    this.setLocalData( program );
                    this.isSubmitting = false;

                }, ( error ) => this.isSubmitting = false );
            }
        },

        created(){

            Survey.initialize( ( def ) => {

                this.fieldsDef = def;

                // TODO - this needs to be much better - will not validate additional fields
                _.forEach( this.fieldsDef, ( def ) => {

                    if( def.validators.length > 0 ) {

                        this.$validator.attach(def.name, def.validators, { alias: def.label });
                    }
                });
                _.forEach( this.fieldsDef.additionaFields, ( field, key ) => this.additionalFields[ key ] = '' );

            } );

            if( this.programId !== undefined ) {

                Survey.get( this.programId, program => this.setLocalData( program ) );
            }
            else if( this.useLocalStorage ) {

                let cachedSurvey = store.get( CACHE_KEY );
                if( cachedSurvey ) {

                    let program = new OutreachProgram();
                    program.restore( cachedSurvey );
                    this.setLocalData( program );
                }
            }

            // TODO - move all this to a mixin?
            window.addEventListener('resize', _.debounce( this.setWindowWidth, 500, {}, false ) );
            this.setWindowWidth();
        },

        updated(){

            _.throttle( this.statusAffixed, 500 )();
        }

    }

</script>

<style lang="scss" scoped>

    .section{

        background-color: #f7f7f7;
        /*border: 1px solid #cfcfcf;*/
        padding: 1.5rem;
        margin-bottom: 35px;
    }

    .survey-status{

        padding: 15px;
        background-color: #f7f7f7;
        /*border: 1px solid #cfcfcf;*/
    }

    .custom-section {

        margin-left: -0.75rem;
        margin-right: -0.75rem;
    }

    .loading{

        margin: 40px 0;

        font-size: 1.3rem;
        line-height: 36px;

        .is-loading{

            margin-right: 15px;
        }
    }

    .progress::-webkit-progress-value {
        transition: width 0.3s ease;
    }

</style>
