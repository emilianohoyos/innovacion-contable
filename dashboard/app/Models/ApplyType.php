<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class ApplyType extends Model
{
    protected $fillable = ['name', 'estimated_days', 'priority', 'destiny'];

    public function applyDocumentTypes()
    {
        return $this->belongsToMany(
            ApplyDocumentType::class,
            'apply_types_apply_document_types',
            'apply_type_id',
            'apply_document_type_id'

        )->withPivot('is_required');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->locale('es')->isoFormat('dddd, D [de] MMMM [de] YYYY h:mm A');
    }
}
