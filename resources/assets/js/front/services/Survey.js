import FormField from '../models/FormField';
import OutreachProgram from '../models/OutreachProgram';

class Survey {

    static initialize( callback ) {

        return axios.get( '/api/survey/form' )
            .then( ( response ) => {

                let def = {};
                _.forEach( response.data.data, ( fieldJson, key ) => {

                    if( _.isArray( fieldJson ) ) {

                        let subfield = {};
                        _.forEach( fieldJson, ( json ) => {

                            let field = new FormField( json );
                            subfield[ field.name ] = field;
                        });

                        def[ key ] = subfield;
                    }
                    else {

                        def[ key ] = new FormField( fieldJson );
                    }


                } );

                callback( def );
            });
    }

    static get( program_id, callback ) {

        axios.get( '/api/survey/' + program_id )
            .then( function( result ) {

                // TODO -- handle error?
                let program = new OutreachProgram();
                program.populate( result.data.data );

                callback( program );
            });
    }

    static create( fields, callback ) {

        axios.post( '/api/survey', fields )
            .then( function( result ) {

                callback( result );
            });
    }

    static update( id, fields, callback ) {

        axios.put( '/api/survey/' + id, fields )
            .then( function( result ) {

                callback( result );
            });
    }
}

export default Survey;