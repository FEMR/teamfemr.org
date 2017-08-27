import School from './School';
import Location from './Location';

class OutreachProgram {

    constructor() {

        this.reset();
    }

    reset() {

        //this.school = new School();
        this.location = new Location();
        this.name = '';
        this.slug = '';
        this.datesOfTravel = '';
        this.schoolClasses = [];
        this.partners = [];
        this.isVisible = false;
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

        this.datesOfTravel = location.outreach_program.months_of_travel;

        _.forEach( location.outreach_program.school_classes, ( school_class ) => {

            this.schoolClasses.push( school_class.name );
        });

        _.forEach( location.outreach_program.partner_organizations, ( partner ) => {

            this.partners.push( partner.name );
        });

        //this.school.name = location.outreach_program.school.name;

        this.location.city_state_country = location.city_state_country;
        this.location.city = location.locality;
        this.location.state = location.administrative_area_level_1;
        this.location.country = location.country;
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