<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplyType extends Model
{
    protected $fillable = ['name', 'estimated_days'];
}