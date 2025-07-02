<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = ['url', 'application_id', 'apply_document_type_id', 'attachment_type'];

    public function application()
    {
        return $this->belongsTo(Application::class, 'application_id');
    }

    public function applyDocumentType()
    {
        return $this->belongsTo(ApplyDocumentType::class, 'apply_document_type_id');
    }
}
