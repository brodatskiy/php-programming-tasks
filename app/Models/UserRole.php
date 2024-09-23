<?php

namespace Project\App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Carbon;

/**
 * @property-read int $id
 * @property-read int $user_id
 * @property-read int $role_id
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 */
class UserRole extends Pivot
{

}