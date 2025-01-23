<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplyDocTypeFolder extends Model
{
    use SoftDeletes;
    protected $fillable = ['folder_id', 'apply_document_type_id', 'is_required'];

    public function folder(): BelongsTo
    {
        return $this->belongsTo(Folder::class, 'folder_id');
    }

    public function applyDocumentType(): BelongsTo
    {
        return $this->belongsTo(ApplyDocumentType::class, 'apply_document_type_id');
    }

    public function monthlyAccountingFolderApplyDocTypeFolders()
    {
        return $this->hasMany(MonthlyAccountingFolderApplyDocTypeFolder::class, 'apply_doc_type_folder_id');
    }
}
