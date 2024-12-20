<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyAccountingFolder extends Model
{

    protected $fillable = ['monthly_accounting_id', 'folder_id', 'is_new', 'status'];


    public function monthlyAccounting()
    {
        return $this->belongsTo(MonthlyAccounting::class, 'monthly_accounting_id');
    }
}
