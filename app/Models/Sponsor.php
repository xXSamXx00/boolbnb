<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sponsor extends Model
{
    public function apartments(): BelongsToMany
    {
        return $this->belongsToMany(Apartment::class);
    }
}
