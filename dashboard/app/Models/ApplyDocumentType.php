<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApplyDocumentType extends Model
{
    use SoftDeletes;
    protected $fillable = ['name'];

    public function folders()
    {
        return $this->belongsToMany(
            Folder::class,                 // Modelo relacionado
            'apply_doc_type_folders',      // Tabla intermedia
            'apply_document_type_id',      // Llave foránea en la tabla intermedia para ApplyDocumentType
            'folder_id'                    // Llave foránea en la tabla intermedia para Folder
        )->withPivot('is_required');       // Incluir columna adicional (is_required) en el resultado
    }
}
