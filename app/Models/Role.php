<?php

namespace Project\App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;


/**
 * @property-read int $id
 * @property string $title
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 *
 * @property-read Collection|User $users
 *
 * @method static Role firstOrCreate(array $attributes = [], array $values = [])
 */
class Role extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = ['title'];

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_role', 'role_id', 'user_id')
            ->withTimestamps();
    }
}
