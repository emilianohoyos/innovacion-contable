<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyAccountingFolder extends Model
{


    public function monthlyAccounting()
    {
        return $this->belongsTo(MonthlyAccounting::class, 'monthly_accounting_id');
    }
}
