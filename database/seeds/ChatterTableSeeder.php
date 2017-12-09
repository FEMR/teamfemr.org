<?php

use FEMR\Data\Models\User;
use Illuminate\Database\Seeder;

class ChatterTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        // create user to make initial posts as
        $user = User::where( 'email' , '=', 'info@teamfemr.org' )->first();
        if( ! $user )
        {
            $user = User::create( [ 'name' => 'Team fEMR', 'email' => 'info@teamfemr.org', 'password' => '' ] );
        }


        // CREATE THE CATEGORIES

        \DB::table('chatter_categories')->delete();
        \DB::table('chatter_categories')->insert([
             0 => [
                 'id'         => 1,
                 'parent_id'  => null,
                 'order'      => 1,
                 'name'       => 'General',
                 'color'      => '#4898db',
                 'slug'       => 'general',
                 'created_at' => null,
                 'updated_at' => null,
             ],
            1 => [
                'id'         => 2,
                'parent_id'  => null,
                'order'      => 2,
                'name'       => 'Feedback',
                'color'      => '#4dcc70',
                'slug'       => 'feedback',
                'created_at' => null,
                'updated_at' => null,
            ],

            2 => [
                'id'         => 3,
                'parent_id'  => null,
                'order'      => 3,
                'name'       => 'Deploying fEMR',
                'color'      => '#e93f53',
                'slug'       => 'deploying-femr',
                'created_at' => null,
                'updated_at' => null,
            ],
            3 => [
                'id'         => 4,
                'parent_id'  => null,
                'order'      => 4,
                'name'       => 'Research',
                'color'      => '#f29c13',
                'slug'       => 'research',
                'created_at' => null,
                'updated_at' => null,
            ],
        ]);

        // CREATE THE DISCUSSIONS

        \DB::table('chatter_discussion')->delete();

        \DB::table('chatter_discussion')->insert([
             [
                 'id'                  => 1,
                 'chatter_category_id' => 1,
                 'title'               => 'Welcome!',
                 'user_id'             => $user->id,
                 'sticky'              => 0,
                 'views'               => 0,
                 'answered'            => 0,
                 'created_at'          => '2016-08-18 14:42:29',
                 'updated_at'          => '2016-08-18 14:42:29',
                 'slug'                => 'welcome',
                 'color'               => '#50a7f0',
             ],
            [
                'id'                  => 2,
                'chatter_category_id' => 2,
                'title'               => 'Leaving Feedback',
                'user_id'             => $user->id,
                'sticky'              => 0,
                'views'               => 0,
                'answered'            => 0,
                'created_at'          => '2016-08-18 14:42:29',
                'updated_at'          => '2016-08-18 14:42:29',
                'slug'                => 'leaving-feedback',
                'color'               => '#4dcc70',
            ]
        ]);

        // CREATE THE POSTS

        \DB::table('chatter_post')->delete();

        \DB::table('chatter_post')->insert([
           [
               'id'                    => 1,
               'chatter_discussion_id' => 1,
               'user_id'               => $user->id,
               'body'                  => '<p>Welcome to the site, some background info on fEMR, the purpose of the site and why</p>',
               'created_at' => '2016-08-18 14:42:29',
               'updated_at' => '2016-08-18 14:42:29',
           ],
            [
                'id'                    => 2,
                'chatter_discussion_id' => 2,
                'user_id'               => $user->id,
                'body'                  => '<p>General message about leaving feedback</p><ul><li>Create new discussion</li><li>Relevant information that is helpful</li><li>Email or alternative place for feedback</li></ul>',
                'created_at' => '2016-08-18 14:42:29',
                'updated_at' => '2016-08-18 14:42:29',
            ],
        ]);
    }
}
