<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Material extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];
    public function material_stok_values(): HasMany
    {
        return $this->hasMany(MaterialStokValue::class);
    }
    public function prixods(): HasMany
    {
        return $this->hasMany(Prixod::class);
    }
}
