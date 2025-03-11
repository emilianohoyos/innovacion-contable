<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryState extends Model
{
    protected $fillable = [
        'state_id',
        'user_id',
        'application_id',
        'changed_at'
    ];
}
