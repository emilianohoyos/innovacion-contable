<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthConfig extends Model
{
    protected $fillable = ['year', 'month', 'end_date', 'start_date'];

    public function getEndDateAttribute($value)
    {
        return $value ? date('Y-m-d', strtotime($value)) : null;
    }
}
