<?php

namespace App;

use App\Concerns\Locatable;
use App\Concerns\Uuid;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Client
 *
 * @package App
 * @author Anitche Chisom
 */
class Client extends Model
{
    use Uuid, Locatable;
}
