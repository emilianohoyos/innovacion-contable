<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientsComment extends Model
{
    protected $fillable = ['client_id', 'description', 'created_by'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
