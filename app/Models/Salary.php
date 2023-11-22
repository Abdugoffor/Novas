<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Salary extends Model
{
    use HasFactory;
    protected $fillable = [
        'staf_id',
        'date',
    ];

    public function staf(): BelongsTo
    {
        return $this->belongsTo(Staf::class, 'staf_id', 'id');
    }
    
    public function salary_type_values(): HasMany
    {
        return $this->hasMany(Salary_Type_Value::class);
    }

    public function fines(): HasMany
    {
        return $this->hasMany(Fines::class);
    }
}
