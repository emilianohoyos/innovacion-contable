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
        'cellphone',
        'user_id',
        'email'
    ];
}
