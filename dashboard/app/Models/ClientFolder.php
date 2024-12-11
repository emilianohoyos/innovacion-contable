<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientFolder extends Model
{
    protected $fillable = ['client_id', 'folder_id'];
}
