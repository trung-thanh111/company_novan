<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\QueryScopes;

class CoreValue extends Model
{
    use HasFactory, SoftDeletes, QueryScopes;

    protected $fillable = [
        'image',
        'publish',
        'order',
        'user_id',
    ];

    protected $table = 'core_values';

    public function languages(){
        return $this->belongsToMany(Language::class, 'core_value_language', 'core_value_id', 'language_id')
        ->withPivot(
            'name',
            'description',
            'content'
        )->withTimestamps();
    }
}
