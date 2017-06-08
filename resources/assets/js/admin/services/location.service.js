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
     * @param address
     * @param address_ext
     * @param locality
     * @param administrative_area_level_1
     * @param administrative_area_level_2
     * @param postal_code
     * @param country
     * @param latitude
     * @param longitude
     * @param start_date
     * @param end_date
     * @returns {*}
     */
    let create = function( programId, address, address_ext, locality, administrative_area_level_1, administrative_area_level_2, postal_code, country, latitude, longitude, start_date, end_date ){

        return axios.post('/admin/programs/' + programId + '/locations', {

            address: address,
            address_ext: address_ext,
            locality: locality,
            administrative_area_level_1: administrative_area_level_1,
            administrative_area_level_2: administrative_area_level_2,
            postal_code: postal_code,
            country: country,
            latitude: latitude,
            longitude: longitude,
            start_date: start_date,
            end_date: end_date
        });

    };

    /**
     * Update an existing Location entity
     *
     * @param programId
     * @param locationId
     * @param address
     * @param address_ext
     * @param locality
     * @param administrative_area_level_1
     * @param administrative_area_level_2
     * @param postal_code
     * @param country
     * @param latitude
     * @param longitude
     * @param start_date
     * @param end_date
     * @returns {*}
     */
    let update = function( programId, locationId, address, address_ext, locality, administrative_area_level_1, administrative_area_level_2, postal_code, country, latitude, longitude, start_date, end_date ){

        return axios.put('/admin/programs/' + programId + '/locations/' + locationId, {

            address: address,
            address_ext: address_ext,
            locality: locality,
            administrative_area_level_1: administrative_area_level_1,
            administrative_area_level_2: administrative_area_level_2,
            postal_code: postal_code,
            country: country,
            latitude: latitude,
            longitude: longitude,
            start_date: start_date,
            end_date: end_date
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