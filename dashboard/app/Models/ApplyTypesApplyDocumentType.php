<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplyTypesApplyDocumentType extends Model
{
    protected $fillable = [
        'apply_type_id',
        'apply_document_type_id',
        'is_required'
    ];
}
