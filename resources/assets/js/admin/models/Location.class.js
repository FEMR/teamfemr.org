class Location {

    constructor() {

        this.id = '';
        this.address = '';
        this.address_ext = '';
        this.locality = '';
        this.administrative_area_level_1 = '';
        this.administrative_area_level_2 = '';
        this.postal_code = '';
        this.country = '';
        this.latitude = '';
        this.longitude = '';
        this.start_date = '';
        this.end_date = '';
    }

    populate( location ){

        this.id = location.id;
        this.address = location.address;
        this.address_ext = location.address_ext;
        this.locality = location.locality;
        this.administrative_area_level_1 = location.administrative_area_level_1;
        this.administrative_area_level_2 = location.administrative_area_level_2;
        this.postal_code = location.postal_code;
        this.country = location.country;
        this.latitude = location.latitude;
        this.longitude = location.longitude;
        this.start_date = location.start_date;
        this.end_date = location.end_date;
    }

    populateFromPlace( place ){

        var components = {};
        for (var i = 0; i < place.address_components.length; i++) {

            var c = place.address_components[i];
            components[c.types[0]] = c;
        }

        if ( components.hasOwnProperty('street_number') ) {

            this.address = components.street_number.long_name + ' '
        }

        if ( components.hasOwnProperty('route') ){

            this.address += components.route.long_name;
        }

        if ( components.hasOwnProperty('subpremise') ){

            this.address_ext = components.subpremise.long_name;
        }

        if ( components.hasOwnProperty('locality') ){

            this.locality = components.locality.long_name;
        }

        if ( components.hasOwnProperty('administrative_area_level_1') ){

            this.administrative_area_level_1 = components.administrative_area_level_1.short_name;
        }

        if ( components.hasOwnProperty('postal_code') ){

            this.postal_code = components.postal_code.long_name;
        }

        if ( components.hasOwnProperty('country') ){

            this.country = components.country.long_name;
        }

        if ( place.hasOwnProperty('geometry') ){

            this.latitude = place.geometry.location.lat().toFixed( 5 );
            this.longitude = place.geometry.location.lng().toFixed( 5 );
        }
    }
}

export default Location;