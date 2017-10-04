class Location {

    constructor() {

        this.id = '';

        this.city ='';
        this.state = '';
        this.country = '';
        this.city_country = '';

        this.position = {};
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
        this.city = ''; // locality
        this.state = ''; // administrative_area_level_1
        this.country = '';
        this.position = {};

        if ( place.hasOwnProperty('id') ){

            this.id = place.id;
        }


        if ( components.hasOwnProperty('locality') ){

            this.city = components.locality.long_name;
        }

        if ( components.hasOwnProperty('administrative_area_level_1') ){

            this.state = components.administrative_area_level_1.short_name;
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