<?php

namespace Project\App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * @property-read int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $api_key
 * @property string $remember_token
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 *
 * @property-read Collection|Role $roles
 * @property-read bool $isAdmin
 *
 * @method static User firstOrCreate(array $attributes = [], array $values = [])
 * @method static User|null firstWhere($column, mixed $operator = null, mixed $value = null, string $boolean = 'and')
 */
class User extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * @var string[]
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'role_id')
            ->withTimestamps();
    }

    public function isAdmin(): bool
    {

        return (bool)$this->roles->where('title', 'admin')->first();

    }
}