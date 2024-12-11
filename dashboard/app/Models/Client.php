<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'person_type_id',
        'document_type_id',
        'user_id',
        'nit',
        'company_name',
        'address',
        'vat_responsible',
        'is_selfretaining',
        'is_simple_taxation_regime',
        'is_ica_withholding_agent',
        'municipality_ica_withholding_agent',
        'is_ica_selfretaining_agent',
        'municipality_ica_selfretaining_agent',
        'observation',
    ];

    public function contactInfo()
    {
        return $this->hasMany(ClientContactInfo::class);
    }

    public function employees()
    {
        return $this->hasMany(EmployeeClient::class, 'client_id');
    }
}
