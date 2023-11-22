<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ModelProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_size',
        'size',
    ];

    public function model_structures(): HasMany
    {
        return $this->hasMany(ModelStructure::class);
    }

    public function model_images(): HasMany
    {
        return $this->hasMany(ModelImage::class);
    }
}
