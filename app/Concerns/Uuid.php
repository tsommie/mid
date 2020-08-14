<?php


namespace App\Concerns;

use Exception;

/**
 * Trait Uuid
 *
 * @package App\Concerns
 * @author Anitche Chisom
 */
trait Uuid
{
    use \GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;

    /**
     * The "booting" method of the model.
     * @throws Exception
     */
    public static function bootUuid(): void
    {
        static::creating(function (self $model): void {
            // Automatically generate a UUID if using them, and not provided.
            $model->uuid = $model->generateUuid();
        });
    }
}
