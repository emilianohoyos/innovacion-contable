<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryState extends Model
{
    protected $fillable = [
        'state_id',
        'user_id',
        'application_id',
        'changed_at',
        'observation'
    ];

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function application()
    {
        return $this->belongsTo(Application::class, 'application_id');
    }
}
