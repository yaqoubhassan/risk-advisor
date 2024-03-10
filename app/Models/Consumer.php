<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consumer extends Model
{
    use HasFactory;

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

    public function submissions()
    {
        return $this->has(Submission::class);
    }
}
