<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Staf extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'adres',
        'img',
        'file',
        'working_time',
        'department_id',
        'salary__type_id',
        'sum',
        'status',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function salary(): HasMany
    {
        return $this->hasMany(Salary::class);
    }

    public function salary_type(): BelongsTo
    {
        return $this->belongsTo(Salary_Type::class, 'salary__type_id', 'id');
    }

    public function equipments(): BelongsToMany
    {
        return $this->belongsToMany(Equipment::class, 'equipment_stafs'); // "equipment_staf" jadvalini aniqlang
    }

    public function salarys(): HasMany
    {
        return $this->hasMany(Salary::class);
    }

    public function couriers(): HasMany
    {
        return $this->hasMany(Courier::class);
    }
}
