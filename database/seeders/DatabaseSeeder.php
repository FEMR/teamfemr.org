<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (app()->environment('local')) {
            $this->call(DevelopmentSeeder::class);
        }

        //$this->call(LocationTablesSeeder::class);
    }
}
