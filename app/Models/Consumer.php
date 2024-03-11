<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consumer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'contact_preference',
        'street_address',
        'apartment',
        'city',
        'state',
        'zip_code'
    ];

    public function submissions(): HasMany
    {
        return $this->hasMany(Submission::class);
    }
}
