<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyAccountingComment extends Model
{
    protected $fillable = [
        'monthly_accounting_folder_id',
        'user_id',
        'user_type',
        'comment',
    ];
}
