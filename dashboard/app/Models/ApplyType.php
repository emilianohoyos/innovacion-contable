<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ApplyType extends Model
{
    protected $fillable = ['name', 'estimated_days', 'priority'];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->locale('es')->isoFormat('dddd, D [de] MMMM [de] YYYY h:mm A');
    }
}
