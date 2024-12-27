<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyAccountingFolderApplyDocTypeFolder extends Model
{
    protected $fillable = [
        'monthly_accounting_folder_id',
        'apply_doc_type_folder_id',
        'is_new',
        'path',
        'status',
        'user_id'
    ];

    public function monthlyAccountingFolder()
    {
        return $this->belongsTo(MonthlyAccountingFolder::class, 'monthly_accounting_folder_id');
    }
}
