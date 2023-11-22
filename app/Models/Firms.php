<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Firms extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'name',
        'prone1',
        'prone2',
        'lang',
        'long',
        'status',
    ];


    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
