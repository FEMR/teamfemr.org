let LocationService = (function(){

    /**
     *
     * @param programId
     * @returns {*}
     */
    let index = function( programId ){

        return axios.get( '/admin/programs/' + programId + '/locations' )
    };

    /**
     * Creates a new Location entity
     *
     * @param programId
     * @param location
     * @returns {*}
     */
    let create = function( programId, location ){

        return axios.post('/admin/programs/' + programId + '/locations', {

            address: location.address,
            address_ext: location.address_ext,
            locality: location.locality,
            administrative_area_level_1: location.administrative_area_level_1,
            administrative_area_level_2: location.administrative_area_level_2,
            postal_code: location.postal_code,
            country: location.country,
            latitude: location.latitude,
            longitude: location.longitude,
            start_date: location.start_date,
            end_date: location.end_date
        });

    };

    /**
     * Update an existing Location entity
     *
     * @param programId
     * @param location
     * @returns {*}
     */
    let update = function( programId, location ){

        if( ! Number.isInteger( location.id ) ) return;

        return axios.put('/admin/programs/' + programId + '/locations/' + location.id, {

            address: location.address,
            address_ext: location.address_ext,
            locality: location.locality,
            administrative_area_level_1: location.administrative_area_level_1,
            administrative_area_level_2: location.administrative_area_level_2,
            postal_code: location.postal_code,
            country: location.country,
            latitude: location.latitude,
            longitude: location.longitude,
            start_date: location.start_date,
            end_date: location.end_date
        })
    };

    /**
     * Delete a Location entity
     *
     * @param programId
     * @param locationId
     * @returns {boolean|*}
     */
    let destroy = function( programId, locationId ){

        return axios.delete( '/admin/programs/' + programId + '/locations/' + locationId );
    };

    return {

        index: index,
        create: create,
        update: update,
        destroy: destroy
    }
})();

export default LocationService;