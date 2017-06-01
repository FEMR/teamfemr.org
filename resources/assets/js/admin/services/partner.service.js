let PartnerService = (function(){

    /**
     *
     * @param programId
     * @returns {*}
     */
    let index = function( programId ){

        return axios.get( '/admin/programs/' + programId + '/partners' )
    };

    /**
     * Creates a new Partner entity
     *
     * @param programId
     * @param name
     * @param website
     * @returns {*}
     */
    let create = function( programId, name, website ){

        return axios.post('/admin/programs/' + programId + '/partners', {

            name: name,
            website: website
        });

    };

    /**
     * Update an existing Partner entity
     *
     * @param programId
     * @param partnerId
     * @param name
     * @param website
     * @returns {*}
     */
    let update = function( programId, partnerId, name, website ){

        return axios.put('/admin/programs/' + programId + '/partners/' + partnerId, {

            name: name,
            website: website
        })
    };

    /**
     * Delete a Partner entity
     *
     * @param programId
     * @param partnerId
     * @returns {boolean|*}
     */
    let destroy = function( programId, partnerId ){

        return axios.delete( '/admin/programs/' + programId + '/partners/' + partnerId );
    };

    return {

        index: index,
        create: create,
        update: update,
        destroy: destroy
    }
})();

export default PartnerService;