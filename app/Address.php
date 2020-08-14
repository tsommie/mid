<?php

namespace App;

use App\Concerns\Uuid;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use Uuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'street', 'street_line_2', 'city', 'country', 'postal',
    ];

    /**
     * Get the owning  model.
     */
    public function locatable()
    {
        return $this->morphTo();
    }
}
