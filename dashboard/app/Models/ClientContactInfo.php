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
        'cellphone',
        'user_id',
        'channel_communication',
        'birthday',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
