<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Nakladnoy extends Model
{
    use HasFactory;
    protected $fillable = [
        'shipper',
        'consignee',
        'nomer',
        'date',
        'sender',
        'recipient',
    ];
    public function prixods(): HasMany
    {
        return $this->hasMany(Prixod::class);
    }
}
