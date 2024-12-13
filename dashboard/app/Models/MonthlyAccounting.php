<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyAccounting extends Model
{
    protected $fillable = [
        'year',
        'month',
        'client_id',
        'employee_id', // Ajusta este campo según tu lógica
        'start_date',
        'end_date',
        'state', // Ajusta este valor según tu lógica
    ];

    public function getEndDateAttribute($value)
    {
        return $value ? date('Y-m-d', strtotime($value)) : null;
    }
}
