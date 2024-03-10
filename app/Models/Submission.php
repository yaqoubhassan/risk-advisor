<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'consumer_id',
        'product_id'
    ];

    public function consumer()
    {
        return $this->belongsTo(Consumer::class);
    }
}
