<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Application extends Model
{
    protected $fillable = [
        'created_by',
        'client_id',
        'apply_type_id',
        'observations',
        'application_date',
        'estimated_delevery_date',
        'state_id',
        'priority',
        'employee_id'
    ];

    public function applyType()
    {
        return $this->belongsTo(ApplyType::class, 'apply_type_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }


    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'application_id');
    }

    public function historyStates(): HasMany
    {
        return $this->hasMany(HistoryState::class, 'application_id');
    }
}
