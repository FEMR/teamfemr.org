<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    //Model portion of the Model-View-Controller system
    //Variables that can be changed in the User table
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function moderator()
    {
        if ($this->isModerator)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

}
