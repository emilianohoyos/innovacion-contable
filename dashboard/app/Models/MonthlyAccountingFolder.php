<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyAccountingFolder extends Model
{

    protected $fillable = ['monthly_accounting_id', 'client_folder_id', 'month_year', 'year', 'is_new', 'status'];

    public function monthlyAccountingFolderApplyDocTypeFolders()
    {
        return $this->hasMany(MonthlyAccountingFolderApplyDocTypeFolder::class, 'monthly_accounting_folder_id');
    }

    public function clientFolder()
    {
        return $this->belongsTo(ClientFolder::class, 'client_folder_id');
    }
}
