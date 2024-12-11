<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientContactInfo extends Model
{
    protected $fillable = [
        'client_id',
        'firstname',
        'lastname',
        'job_title',
        'email',
        'cellphone'
    ];
}
