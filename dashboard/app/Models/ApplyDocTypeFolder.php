<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplyDocTypeFolder extends Model
{
    protected $fillable = ['folder_id', 'apply_document_type_id', 'is_required'];
}
