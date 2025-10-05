<?php

use FEMR\Data\Models\School;
use Illuminate\Database\Seeder;

class SchoolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if( ( $handle = fopen( 'resources/data/us-schools.csv', 'r' ) ) !== false )
        {
            // get column headers so that they are:
            //   $headers => [
            //      'column_header' => column_index
            //   ]
            $headers = array_flip( fgetcsv($handle) );

            //dd( $headers );

            while ( ($data = fgetcsv($handle)) !== false) {

                //dd( $data );

                // Columns
                // School Name, Location, Trips?, Contact Information, Notes

                if( strlen( $data[ $headers['School Name'] ] ) > 0 ) {

                    School::create(
                        [

                            'name' => $data[$headers['School Name']],
                            'has_trips' => stripos( $data[$headers['Trips?']], "yes" ) !== false ? true : false,
                            'notes' => $data[$headers['Notes']]
                        ] );

                    //
                    // Try to make contact records out of the free form field
                    //
                    if ( strlen( $data[$headers['Contact Information']] ) > 0 ) {
                        //
                        // Do some magic stuff to try to extract names and emails from a free form text field
                        //
                    }

                }
                unset( $data );
            }
            fclose( $handle );
        }
    }
}
