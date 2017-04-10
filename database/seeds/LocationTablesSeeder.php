<?php

use FEMR\Data\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LocationTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->importCountriesFile();
        $this->importCitiesFile();
    }
    
    /**
     * Import Country data from a csv file
     */
    public function importCountriesFile()
    {
        // TODO -- finalize the data source for country data
        // http://data.okfn.org/data/core/country-codes#readme
        if(($handle = fopen('resources/data/country-codes.csv', 'r')) !== false)
        {
            // get column headers so that they are:
            //   $headers => [
            //      'column_header' => column_index
            //   ]
            $headers = array_flip( fgetcsv($handle) );

            //dd( $headers );

            while (($data = fgetcsv($handle)) !== false) {

                //dd( $data );

                Country::create([

                    'name'             => $data[ $headers['name'] ],
                    'official_name_en' => $data[ $headers['official_name_en'] ],
                    'official_name_fr' => $data[ $headers['official_name_fr'] ],
                    'slug'             => Str::slug( $data[ $headers['official_name_en'] ] ),
                    'code_2'           => $data[ $headers['ISO3166-1-Alpha-2'] ],
                    'code_3'           => $data[ $headers['ISO3166-1-Alpha-3'] ],
                    'capital'          => $data[ $headers['Capital'] ],
                    'continent'        => $data[ $headers['Continent'] ]

                ]);


                unset($data);
            }
            fclose($handle);
        }
    }

    /**
     * Import City data from a csv file
     */
    public function importCitiesFile()
    {
        // TODO -- finalize the data source for city data
        // https://www.maxmind.com/en/free-world-cities-database
        if(($handle = fopen('resources/data/world-cities-pop.csv', 'r')) !== false)
        {
            // get column headers so that they are:
            //   $headers => [
            //      'column_header' => column_index
            //   ]
            $headers = array_flip( fgetcsv($handle) );

            //dd( $headers );

            $ct = 0;
            while ( !feof( $handle ) ) {

                $data = fgetcsv($handle);

                //dd( $data );

                $ct++;
                echo $ct . $data[ $headers['City'] ] . PHP_EOL;

                //Country,City,AccentCity,Region,Population,Latitude,Longitude
                //ad,aixas,Aixàs,06,,42.4833333,1.4666667

                // Find country by country code
                $country = Country::hasCode( strtoupper( $data[ $headers['Country'] ] ) )->first();

                if( ! is_null( $country ) ) {

                    $country->cities()->create([

                        'name'         => $data[ $headers['City'] ],
                        'name_accents' => $data[ $headers['AccentCity'] ],
                        'slug'         => Str::slug($data[ $headers['City'] ]),
                        'population'   => $data[ $headers['Population'] ],
                        'latitude'     => $data[ $headers['Latitude'] ],
                        'longitude'    => $data[ $headers['Longitude'] ]

                    ]);
                }
                else
                {
                    echo 'No country found for: ' . $data[ $headers['Country'] ] . PHP_EOL;
                }

                unset($data);
            }
            fclose($handle);
        }
    }
}
