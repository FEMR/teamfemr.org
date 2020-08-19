<?php

namespace FEMR\Listeners\Forum;

use DevDojo\Chatter\Events\ChatterAfterNewResponse;
use FEMR\Mail\Forum\ResponseCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNewResponseEmail
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
     * @param  ChatterAfterNewResponse  $event
     * @return void
     */
    public function handle( ChatterAfterNewResponse $event )
    {
        // $event->post
        \Mail::to( 'info@teamfemr.org' )->send( new ResponseCreated( $event->request ) );
    }
}
