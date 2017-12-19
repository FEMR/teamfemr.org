<?php

namespace FEMR\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'DevDojo\Chatter\Events\ChatterAfterNewDiscussion' => [
            'FEMR\Listeners\Forum\SendNewDiscussionEmail',
        ],
        'DevDojo\Chatter\Events\ChatterAfterNewResponse' => [
            'FEMR\Listeners\Forum\SendNewResponseEmail',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
