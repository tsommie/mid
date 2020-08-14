<?php


namespace App\Concerns;

use App\Address;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * Trait Locatable
 *
 * @package App\Concerns
 */
trait Locatable
{
    /**
     * Get the address for this entity.
     *
     * @return MorphOne
     */
    public function address()
    {
        return $this->morphOne(Address::class, 'locatable');
    }
}
