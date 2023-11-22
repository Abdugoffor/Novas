<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Courier extends Model
{
    use HasFactory;
    protected $fillable = [
        'staf_id',
        'phone',
        'car_number',
        'telegram_id',
        'status',
    ];


    public function staf(): BelongsTo
    {
        return $this->belongsTo(Staf::class);
    }
}
