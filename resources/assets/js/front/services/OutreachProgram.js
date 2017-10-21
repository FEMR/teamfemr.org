import store from 'store';
import expirePlugin from 'store/plugins/expire';
store.addPlugin(expirePlugin);

import { default as OutreachProgramModel } from '../models/OutreachProgram';


class OutreachProgram {

    static index( callback ) {

        const CACHE_KEY = 'FEMR.programs';
        let cachedLocations = store.get( CACHE_KEY );

        if( cachedLocations ) {

            console.log( "loaded from cache" );
            this.locations = cachedLocations;
        }
        else {

            axios.get( '/api/programs' )
                .then( ( response ) => {

                    let programs = [];

                    _.forEach( response.data, ( program_json ) => {

                        let program = new OutreachProgramModel();
                        program.populate( program_json );
                        programs.push( program );
                    });

                    // put the locations in local storage
                    //store.set( CACHE_KEY, programs, Date.now() + 30 * 60 * 1000 /* 30 minutes in ms */);

                    callback( programs ) ;
                })
                .catch( ( error ) => console.log( error ) );
        }
    }
}

export default OutreachProgram;