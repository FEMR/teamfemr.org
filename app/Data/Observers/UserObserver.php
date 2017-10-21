<?php

namespace FEMR\Data\Observers;

use FEMR\Data\Models\User;

/**
 * Class UserObserver
 * @package App\Data\Observers
 */
class UserObserver
{

    /**
     * @param User $user
     */
    public function saving( User $user )
    {
        $user->api_token = str_random( 40 );
    }

}