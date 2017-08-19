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

        this.yearInitiated = '';
        this.yearlyOutreachParticipants = '';
        this.matriculantsPerClass = '';

        this.schoolClasses = [];
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

        this.yearInitiated = location.outreach_program.year_initiated;
        this.yearlyOutreachParticipants = location.outreach_program.yearly_outreach_participants;
        this.matriculantsPerClass = location.outreach_program.matriculants_per_class;

        _.forEach( location.outreach_program.school_classes, (school_class ) => {

           this.schoolClasses.push( school_class.name );
        });

        //this.school.name = location.outreach_program.school.name;

        this.location.city_state_country = location.city_state_country;
        this.location.city = location.locality;
        this.location.state = location.administrative_area_level_1;
        this.location.country = location.country;
    }
    
}

export default OutreachProgram;