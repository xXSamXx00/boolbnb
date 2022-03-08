<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    protected $table = 'contacts';
    protected $fillable = ['apartment_id','oggetto_mail', 'email', 'message', 'name'];

    public function apartment(): BelongsTo
    {
        return $this->belongsTo(Apartment::class);
    }
    
}
