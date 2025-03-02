<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Folder extends Model
{
    protected $fillable = ['name', 'periodicity'];

    public function ApplyDocTypeFolders(): HasMany
    {
        return $this->hasMany(ApplyDocTypeFolder::class, 'folder_id');
    }

    public function applyDocumentTypes(): BelongsToMany
    {
        return $this->belongsToMany(
            ApplyDocumentType::class,       // Modelo relacionado
            'apply_doc_type_folders',      // Tabla intermedia
            'folder_id',                   // Llave foránea en la tabla intermedia para Folder
            'apply_document_type_id'       // Llave foránea en la tabla intermedia para ApplyDocumentType
        )->withPivot('is_required');       // Incluir columna adicional (is_required) en el resultado
    }

    public function monthlyAccountingFolders(): HasMany
    {
        return $this->hasMany(MonthlyAccountingFolder::class, 'folder_id');
    }
}
