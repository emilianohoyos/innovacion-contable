<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'document_type_id',
        'identification',
        'firstname',
        'lastname',
        'job_title',
        'role',
        'cellphone',
        'user_id',
        'email',
        'active',
        'emergency_contact_name',
        'emergency_contact_phone',
        'emergency_contact_address',
        'profession',
        'profession_description',
        'observation'
    ];
}
