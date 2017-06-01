<?php

namespace FEMR\Data\Models;

use FEMR\Data\Utilities\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PartnerOrganization extends Model
{
    use SoftDeletes, HasSlug;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'partner_organizations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'website'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'name'    => 'string',
        'slug'    => 'string',
        'website' => 'string'
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
    public function outreachPrograms()
    {
        return $this->belongsToMany( OutreachProgram::class, 'outreach_program_partner', 'partner_id', 'outreach_program_id' );
    }
}
