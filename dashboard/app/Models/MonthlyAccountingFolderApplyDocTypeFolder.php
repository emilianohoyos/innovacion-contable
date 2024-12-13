<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyAccountingFolderApplyDocTypeFolder extends Model
{
    //
    public function monthlyAccountingFolder()
    {
        return $this->belongsTo(MonthlyAccountingFolder::class, 'monthly_accounting_folder_id');
    }
}
