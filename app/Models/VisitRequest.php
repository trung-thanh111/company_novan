<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\HasQuery;

class VisitRequest extends Model
{
    use HasFactory, Notifiable, SoftDeletes, HasQuery;

    protected $fillable = [
        'service_id',
        'full_name',
        'email',
        'phone',
        'preferred_date',
        'preferred_time',
        'message',
        'status',
        'admin_notes',
        'assigned_agent_id',
        'user_id',
    ];

    protected $casts = [];

    protected $relationable = ['users', 'services'];

    public function getRelationable()
    {
        return $this->relationable;
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function services(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }
}
