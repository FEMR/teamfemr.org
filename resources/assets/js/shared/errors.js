class Errors {


    constructor() {

        this.errors = {};
    }

    /**
     *
     * @param errors
     */
    record( errors ) {

        this.errors = errors;
    }

    /**
     *
     * @param index
     * @returns {boolean}
     */
    has( index ) {

        return this.errors.hasOwnProperty( index );
    }

    /**
     *
     * @param index
     * @returns {*}
     */
    get( index ) {

        if( this.errors[ index ] ) {

            return this.errors[ index ][0];
        }
    }

    /**
     *
     * @returns {Number}
     */
    size() {

        return Object.keys( this.errors ).length;
    }

    /**
     * Clear out the errors
     */
    clear() {

        this.errors = {};
    }

}

export default Errors;