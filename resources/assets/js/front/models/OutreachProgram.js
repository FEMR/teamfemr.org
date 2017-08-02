import School from './School';
import Location from './Location';

class OutreachProgram {

    constructor() {

        this.reset();
    }

    reset() {

        this.school = new School();
        this.location = new Location();
        this.name = '';
        this.slug = '';
    }

    /**
     * Location has outreachProgram and school attached from API
     * - TODO - rethink how the data is returned, might be better to match structure to what the front end is expecting
     *      - location.outreachProgram vs. outreachProgram.location
     *
     * @param location
     */
    populateFromLocation( location ) {

        this.name = location.outreach_program.name;
        this.slug = location.outreach_program.slug;

        this.school.name = location.outreach_program.school.name;

        this.location.state = location.administrative_area_level_1;
        this.location.country = location.country;
    }
}

export default OutreachProgram;