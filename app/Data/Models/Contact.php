<?php

namespace FEMR\Data\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contacts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'prefix',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'full_name',
        'title',
        'phone',
        'email',
        'notes',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'prefix'      => 'string',
        'first_name'  => 'string',
        'middle_name' => 'string',
        'last_name'   => 'string',
        'suffix'      => 'string',
        'title'       => 'string',
        'phone'       => 'string',
        'email'       => 'string',
        'notes'       => 'string'
    ];

    /**
     * The attributes that should not be encoded to json
     *
     * @var array
     */
    protected $hidden = [

        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function school()
    {
        return $this->belongsToMany( School::class );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function outreachProgram()
    {
        return $this->belongsToMany( OutreachProgram::class, 'outreach_program_contact' );
    }
}
