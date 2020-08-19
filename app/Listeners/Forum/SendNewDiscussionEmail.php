<?php

namespace FEMR\Listeners\Forum;

use DevDojo\Chatter\Events\ChatterAfterNewDiscussion;
use FEMR\Mail\Forum\DiscussionCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNewDiscussionEmail
{
    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ChatterAfterNewDiscussion  $event
     * @return void
     */
    public function handle( ChatterAfterNewDiscussion $event )
    {
        // $event->discussion
        // $event->post
        \Mail::to( 'info@teamfemr.org' )->send( new DiscussionCreated( $event->request ) );
    }
}
