<?php

use Carbon\Carbon;
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
            $user = User::create( [ 'name' => 'Team fEMR', 'email' => 'info@teamfemr.org', 'password' => '', 'api_token' => str_random( 40 ) ] );
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
                 'title'               => 'General Discussions',
                 'user_id'             => $user->id,
                 'sticky'              => 0,
                 'views'               => 0,
                 'answered'            => 0,
                 'created_at'          => Carbon::now(),
                 'updated_at'          => Carbon::now(),
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
                'created_at'          => Carbon::now(),
                'updated_at'          => Carbon::now(),
                'slug'                => 'leaving-feedback',
                'color'               => '#4dcc70',
            ],
//             [
//                 'id'                  => 3,
//                 'chatter_category_id' => 3,
//                 'title'               => 'Deploying fEMR',
//                 'user_id'             => $user->id,
//                 'sticky'              => 0,
//                 'views'               => 0,
//                 'answered'            => 0,
//                 'created_at'          => Carbon::now(),
//                 'updated_at'          => Carbon::now(),
//                 'slug'                => 'deploying-femr',
//                 'color'               => '#4dcc70',
//             ],
//             [
//                 'id'                  => 4,
//                 'chatter_category_id' => 4,
//                 'title'               => 'Research',
//                 'user_id'             => $user->id,
//                 'sticky'              => 0,
//                 'views'               => 0,
//                 'answered'            => 0,
//                 'created_at'          => Carbon::now(),
//                 'updated_at'          => Carbon::now(),
//                 'slug'                => 'research',
//                 'color'               => '#4dcc70',
//             ]
        ]);

        // CREATE THE POSTS

        \DB::table('chatter_post')->delete();

        \DB::table('chatter_post')->insert([
            [
               'id'                    => 1,
               'chatter_discussion_id' => 1,
               'user_id'               => $user->id,
               'body'                  => '<p>Welcome! This is for general discussion about short term medical relief trips, sustainability, data sharing, etc. Thank you for contributing!</p>',
               'created_at' => Carbon::now(),
               'updated_at' => Carbon::now(),
            ],
            [
                'id'                    => 2,
                'chatter_discussion_id' => 2,
                'user_id'               => $user->id,
                'body'                  => '<p>We are eager to hear your feedback! Let us know what you think about this website, the survey, or fEMR.</p><p>If you would like to leave anonymous feedback about fEMR itself, please <a href="https://demo.teamfemr.org/" target="_blank">login to our demo</a></p><ul><li>username: visitor<br></li><li>password: fEMR2016<br></li></ul>',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
//            [
//               'id'                    => 3,
//               'chatter_discussion_id' => 3,
//               'user_id'               => $user->id,
//               'body'                  => '<p>Share comments and questions about deploying the fEMR system here.</p>',
//               'created_at' => Carbon::now(),
//               'updated_at' => Carbon::now(),
//            ],
//            [
//               'id'                    => 4,
//               'chatter_discussion_id' => 4,
//               'user_id'               => $user->id,
//               'body'                  => '<p>Discussions about research regarding transient healthcare delivery.</p>',
//               'created_at' => Carbon::now(),
//               'updated_at' => Carbon::now(),
//            ],
        ]);
    }
}
