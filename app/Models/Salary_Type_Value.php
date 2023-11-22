<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Salary_Type_Value extends Model
{
    use HasFactory;
    protected $fillable = [
        'salary_id',
        'type_id',
        'value',
    ];

    public function salary(): BelongsTo
    {
        return $this->belongsTo(Salary::class, 'salary_id', 'id');
    }
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }
}
