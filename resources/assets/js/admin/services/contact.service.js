let ContactService = (function(){

    /**
     *
     * @param programId
     * @returns {*}
     */
    let index = function( programId ){

        return axios.get( '/admin/programs/' + programId + '/contacts' )
    };

    /**
     * Creates a new Contact entity
     *
     * @param programId
     * @param prefix
     * @param first_name
     * @param middle_name
     * @param last_name
     * @param suffix
     * @param title
     * @param phone
     * @param email
     * @param notes
     *
     * @returns {*}
     */
    let create = function( programId, prefix, first_name, middle_name, last_name, suffix, title, phone, email, notes ){

        return axios.post('/admin/programs/' + programId + '/contacts', {

            prefix: prefix,
            first_name: first_name,
            middle_name: middle_name,
            last_name: last_name,
            suffix: suffix,
            title: title,
            phone: phone,
            email: email,
            notes: notes
        });

    };

    /**
     * Update an existing Contact entity
     *
     * @param programId
     * @param contactId
     * @param prefix
     * @param first_name
     * @param middle_name
     * @param last_name
     * @param suffix
     * @param title
     * @param phone
     * @param email
     * @param notes
     *
     * @returns {*}
     */
    let update = function( programId, contactId, prefix, first_name, middle_name, last_name, suffix, title, phone, email, notes ){

        return axios.put('/admin/programs/' + programId + '/contacts/' + contactId, {

            prefix: prefix,
            first_name: first_name,
            middle_name: middle_name,
            last_name: last_name,
            suffix: suffix,
            title: title,
            phone: phone,
            email: email,
            notes: notes
        })
    };

    /**
     * Delete a Contact entity
     *
     * @param programId
     * @param contactId
     * @returns {boolean|*}
     */
    let destroy = function( programId, contactId ){

        return axios.delete( '/admin/programs/' + programId + '/contacts/' + contactId );
    };

    return {

        index: index,
        create: create,
        update: update,
        destroy: destroy
    }
})();

export default ContactService;