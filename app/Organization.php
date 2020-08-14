<?php

namespace App;

use App\Concerns\Locatable;
use App\Concerns\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    use Uuid, Locatable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'email', 'phone_number', 'website', 'user_id'
    ];

    /**
     * Get the user that owns this organization.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the organizations owned by the user.
     *
     * @return HasMany
     */
    public function organizations()
    {
        return $this->hasMany(Organization::class);
    }

}
