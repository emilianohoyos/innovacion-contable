<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplyTypesApplyDocumentType extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'apply_type_id',
        'apply_document_type_id',
        'is_required'
    ];
}
