<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyAccountingFolder extends Model
{

    protected $fillable = ['monthly_accounting_id', 'client_folder_id', 'month_year', 'is_new', 'status'];

    public function monthlyAccountingFolderApplyDocTypeFolders()
    {
        return $this->hasMany(MonthlyAccountingFolderApplyDocTypeFolder::class, 'monthly_accounting_folder_id');
    }
}
