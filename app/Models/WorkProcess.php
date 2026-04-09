<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\QueryScopes;

class WorkProcess extends Model
{
    use HasFactory, SoftDeletes, QueryScopes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'image',
        'publish',
        'order',
        'user_id',
    ];

    /**
     * @var string
     */
    protected $table = 'work_processes';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function languages()
    {
        return $this->belongsToMany(Language::class, 'work_process_language', 'work_process_id', 'language_id')
            ->withPivot(
                'name',
                'description',
                'content'
            )->withTimestamps();
    }
}
