<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClientFolder extends Model
{
    protected $fillable = ['client_id', 'folder_id'];


    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }

    public function monthlyAccountingFolders(): HasMany
    {
        return $this->hasMany(MonthlyAccountingFolder::class, 'client_folder_id');
    }
}
