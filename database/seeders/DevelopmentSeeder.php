<?php

namespace Database\Seeders;

use FEMR\Data\Models\Contact;
use FEMR\Data\Models\News;
use FEMR\Data\Models\OutreachProgram;
use FEMR\Data\Models\Paper;
use FEMR\Data\Models\PartnerOrganization;
use FEMR\Data\Models\Publication;
use FEMR\Data\Models\School;
use FEMR\Data\Models\SchoolClass;
use FEMR\Data\Models\User;
use FEMR\Data\Models\VisitedLocation;
use Illuminate\Database\Seeder;

class DevelopmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create users
        $users = User::factory()->count(10)->create();

        // Create schools
        School::factory()->count(15)->create();

        // Create school classes
        $schoolClasses = SchoolClass::factory()->count(10)->create();

        // Create partner organizations
        $partnerOrganizations = PartnerOrganization::factory()->count(8)->create();

        // Create contacts
        $contacts = Contact::factory()->count(25)->create();

        // Create outreach programs with relationships
        OutreachProgram::factory()->count(12)
            ->approved()
            ->create()
            ->each(function ($program) use ($users, $schoolClasses, $partnerOrganizations, $contacts) {
                // Attach users to programs
                $program->users()->attach(
                    $users->random(rand(1, 3))->pluck('id')->toArray()
                );

                // Attach school classes
                $program->schoolClasses()->attach(
                    $schoolClasses->random(rand(1, 4))->pluck('id')->toArray(),
                    ['class_size' => rand(20, 100)]
                );

                // Attach partner organizations
                $program->partnerOrganizations()->attach(
                    $partnerOrganizations->random(rand(1, 3))->pluck('id')->toArray()
                );

                // Attach contacts
                $program->contacts()->attach(
                    $contacts->random(rand(1, 4))->pluck('id')->toArray()
                );

                // Create visited locations for each program
                VisitedLocation::factory()
                    ->count(rand(1, 5))
                    ->withProgram($program)
                    ->create();

                // Create papers for some programs
                if (rand(1, 100) <= 60) { // 60% chance
                    Paper::factory()
                        ->count(rand(1, 3))
                        ->withProgram($program)
                        ->create();
                }
            });

        // Create some pending outreach programs
        OutreachProgram::factory()->count(3)
            ->pending()
            ->create()
            ->each(function ($program) use ($users) {
                $program->users()->attach(
                    $users->random(1)->pluck('id')->toArray()
                );
            });

        // Create news articles
        News::factory()->count(20)->create();
        News::factory()->count(5)->featured()->create();

        // Create publications
        Publication::factory()->count(8)->create();
    }
}