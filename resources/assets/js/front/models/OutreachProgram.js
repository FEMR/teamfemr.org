import Partner from './Partner';
import Paper from './Paper';
import Contact from './Contact';
import VisitedLocation from './VisitedLocation';

class OutreachProgram {

    constructor() {

        this.reset();
    }

    reset() {

        this.id = '';

        this.name = '';
        this.slug = '';
        this.schoolName = '';
        this.usesEmr = false;
        this.matriculantsPerClass = '';
        this.yearInitiated = '';
        this.yearlyOutreachParticipants = '';
        this.monthsOfTravel = '';
        this.comments = '';

        this.additionalFields = {};
        this.schoolClasses = [];
        this.contacts = [];
        this.partners = [];
        this.papers = [];
        this.visitedLocations = [];

        this.lastUpdated = '';
        this.isVisible = false;
    }

    populate( json ) {

        this.id = json.id;
        this.name = json.name;
        this.slug = json.slug;
        this.schoolName = json.schoolName;
        this.usesEmr = json.usesEmr;
        this.matriculantsPerClass = json.matriculantsPerClass;
        this.yearInitiated = json.yearInitiated;
        this.yearlyOutreachParticipants = json.yearlyOutreachParticipants;
        this.comments = json.comments;
        this.lastUpdated = json.lastUpdated;

        this.additionalFields = {};
        _.forEach( json.additionalFields, ( value, key ) => {

           this.additionalFields[ key ] = value;
        });

        //this.monthsOfTravel = json.monthsOfTravel;
        this.monthsOfTravel = [];
        _.forEach( json.monthsOfTravel, ( month ) => {

            // this is matched up to what the MultiSelectField in the survey wants
            this.monthsOfTravel.push( {

                label: month,
                value: month
            });
        });

        this.schoolClasses = [];
        _.forEach( json.schoolClasses, ( schoolClass, key ) => {

            // this is matched up to what the MultiSelectField in the survey wants
            this.schoolClasses.push( {

                label: schoolClass.name,
                value: schoolClass.slug
            });
        });

        _.forEach( json.contacts, ( contact ) => {

            let newContact = new Contact();
            newContact.populate( contact );

            this.contacts.push( newContact );
        });

        _.forEach( json.partnerOrganizations, ( partner ) => {

            let newPartner = new Partner();
            newPartner.populate( partner );

            this.partners.push( newPartner );
        });

        _.forEach( json.visitedLocations, ( location ) => {

            let newLoc = new VisitedLocation();
            newLoc.populate( location );

            this.visitedLocations.push( newLoc );
        });

        _.forEach( json.papers, ( paper ) => {

            let newPaper = new Paper();
            newPaper.populate( paper );

            this.papers.push( newPaper );
        });
    }

    schoolClassesList() {

        return this.schoolClasses.map( item => item.label ).join( ', ' );
    }

    partnersList() {

        return this.partners.map( item => item.name ).join( ', ' );
    }

    firstLocationCityStateCountry() {

        if( this.visitedLocations.length > 0 ) {

            return this.visitedLocations[0].cityStateCountry;
        }

        return '';
    }

    programPageUrl() {

        if( this.slug.length > 0 ) {

            return '/programs/' + this.slug;
        }
        else return '#';
    }

    post() {

        return  {
            "id": this.id,
            "name": this.name,
            "slug": this.slug,
            "schoolName": this.schoolName,
            "usesEmr": this.usesEmr = false,
            "matriculantsPerClass": this.matriculantsPerClass,
            "yearInitiated": this.yearInitiated,
            "yearlyOutreachParticipants": this.yearlyOutreachParticipants,
            "monthsOfTravel": this.monthsOfTravel,
            "comments": this.comments,
            "additionalFields": this.additionalFields,
            "schoolClasses": this.schoolClasses,
            "isVisible": this.isVisible,
            "lastUpdated": this.lastUpdated,

            "contacts": _.map( this.contacts, ( contact ) => contact.post() ),
            "partners": _.map( this.partners, ( partner ) => partner.post() ),
            "papers": _.map( this.papers, ( paper ) => paper.post() ),
            "visitedLocations": _.map( this.visitedLocations, ( location ) => location.post() ),
        };
    }
}

export default OutreachProgram;