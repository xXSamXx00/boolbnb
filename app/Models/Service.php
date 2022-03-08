<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    protected $table = 'services';

    public function apartments(): BelongsToMany
    {
        return $this->belongsToMany(Apartment::class);
    }
}