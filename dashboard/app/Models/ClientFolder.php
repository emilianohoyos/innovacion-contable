<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientFolder extends Model
{
    protected $fillable = ['client_id', 'folder_id'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }


    public function folder(): BelongsTo
    {
        return $this->belongsTo(Folder::class, 'folder_id');
    }
}
