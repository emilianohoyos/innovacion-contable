<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplyAttachment extends Model
{
    protected $fillable = [
        'application_id',
        'path',
        'original_name',
        'uploaded_by',
    ];
}
