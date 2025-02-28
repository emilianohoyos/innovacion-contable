<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientContactInfo extends Model
{
    protected $fillable = [
        'client_id',
        'document_type_id',
        'identification',
        'firstname',
        'lastname',
        'job_title',
        'email',
        'cellphone',
        'user_id',
        'channel_communication',
        'birthday',
        'observation'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }
}
