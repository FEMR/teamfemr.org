import Partner from './Partner';
import Paper from './Paper';
import Contact from './Contact';
import VisitedLocation from './VisitedLocation';

class OutreachProgram {

    constructor() {

        this.reset();
    }

    reset() {

        //this.school = new School();

        this.name = '';
        this.slug = '';
        this.schoolName = '';
        this.usesEmr = false;
        this.matriculantsPerClass = '';
        this.yearInitiated = '';
        this.yearlyOutreachParticipants = '';
        this.monthsOfTravel = '';

        this.schoolClasses = [];
        this.contacts = [];
        this.partners = [];
        this.papers = [];
        this.visitedLocations = [];

        this.isVisible = false;
    }

    populate( json ) {

        console.log( json );

        this.name = json.name;
        this.slug = json.slug;
        this.schoolName = json.school_name;
        this.usesEmr = json.uses_emr;
        this.matriculantsPerClass = json.matriculants_per_class;
        this.yearInitiated = json.year_initiated;
        this.yearlyOutreachParticipants = json.yearly_outreach_participants;
        this.monthsOfTravel = json.months_of_travel;

        this.additionalFields = {};
        _.forEach( json.fields, ( field ) => {

           this.additionalFields[ field.key ] = field.value;
        });

        _.forEach( json.school_classes, ( school_class ) => {

            // this is matched up to what the MultiSelectField in the survey wants
            this.schoolClasses.push( {

                label: school_class.name,
                value: school_class.slug
            });
        });

        _.forEach( json.contacts, ( contact ) => {

            let newContact = new Contact();
            newContact.populate( contact );

            this.contacts.push( newContact );
        });

        _.forEach( json.partner_organizations, ( partner ) => {

            let newPartner = new Partner();
            newPartner.populate( partner );

            this.partners.push( newPartner );
        });

        _.forEach( json.visited_locations, ( location ) => {

            let newLoc = new VisitedLocation();
            newLoc.populate( location );

            this.visitedLocations.push( newLoc );
        });

        // TODO -- make models for this
        _.forEach( json.papers, ( paper ) => {

            let newPaper = new Paper();
            newPaper.populate( paper );

            this.papers.push( newPaper );
        });
    }

    /**
     * Location has outreachProgram and school attached from API
     * - TODO - rethink how the data is returned, might be better to match structure to what the front end is expecting
     *      - location.outreachProgram vs. outreachProgram.location
     *
     * @param location
     */
    populateFromLocation( location ) {

        this.reset();

        this.name = location.outreach_program.name;
        this.slug = location.outreach_program.slug;

        this.monthsOfTravel = location.outreach_program.months_of_travel;

        _.forEach( location.outreach_program.school_classes, ( school_class ) => {

            this.schoolClasses.push( school_class.name );
        });

        _.forEach( location.outreach_program.partner_organizations, ( partner ) => {

            this.partners.push( partner.name );
        });

        //this.school.name = location.outreach_program.school.name;

        let newLoc = new Location();
        newLoc.populate( location );
        this.visitedLocations.push( newLoc );

    }

    firstLocationCityStateCountry() {

        if( this.visitedLocations.length > 0 ) {

            return this.visitedLocations[0].city_state_country;
        }

        return '';
    }

    /**
     *
     * @returns {*}
     */
    programPageUrl() {

        if( this.slug.length > 0 ) {

            return '/programs/' + this.slug;
        }
        else return '#';
    }
}

export default OutreachProgram;