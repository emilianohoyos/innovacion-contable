<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Client extends Model
{
    protected $fillable = [
        'person_type_id',
        'document_type_id',
        'nit',
        'company_name',
        'address',
        'observation',
        'email',
        'category',
        'review'

    ];

    public function contactInfo()
    {
        return $this->hasMany(ClientContactInfo::class);
    }

    public function commentsClient()
    {
        return $this->hasMany(ClientsComment::class);
    }

    public function employees()
    {
        return $this->hasMany(EmployeeClient::class, 'client_id');
    }
    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function personType()
    {
        return $this->belongsTo(PersonType::class);
    }
    public function clientResponsible()
    {
        return $this->hasOne(ClientResponsible::class);
    }
}
