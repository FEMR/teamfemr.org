class Location {

    constructor() {

        this.uniqueId = _.uniqueId();;

        this.id = '';
        this.locality ='';
        this.administrative_area_level_1 = '';
        this.country = '';
        this.city_state_country = '';

        this.position = {};
    }

    populate( json ) {

        this.id = json.id;
        this.city_state_country = json.city_state_country;
        this.locality = json.locality;
        this.administrative_area_level_1 = json.administrative_area_level_1;
        this.country = json.country;

        this.position['lat'] = parseFloat( json.latitude );
        this.position['lng'] = parseFloat( json.longitude );
    }

    populateFromPlace( place ){

        // do nothing is place does not have an address
        if( ! _.has( place, [ 'geometry', 'location' ] ) ) return;

        var components = {};
        for (var i = 0; i < place.address_components.length; i++) {

            var c = place.address_components[i];
            components[c.types[0]] = c;
        }

        // Reset fields so previous info is not left behind
        this.locality = ''; // city
        this.administrative_area_level_1 = ''; // state
        this.country = '';
        this.position = {};


        if ( components.hasOwnProperty('locality') ){

            this.locality = components.locality.long_name;
        }

        if ( components.hasOwnProperty('administrative_area_level_1') ){

            this.administrative_area_level_1 = components.administrative_area_level_1.short_name;
        }

        if ( components.hasOwnProperty('country') ){

            this.country = components.country.long_name;
        }

        if ( place.hasOwnProperty('geometry') ){

            this.position['lat'] = parseFloat( place.geometry.location.lat().toFixed( 5 ) );
            this.position['lng'] = parseFloat( place.geometry.location.lng().toFixed( 5 ) );
        }
    }
}

export default Location;