<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeClient extends Model
{
    protected $fillable = ['client_id', 'employee_id'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
