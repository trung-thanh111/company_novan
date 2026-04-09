<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\QueryScopes;

class Achievement extends Model
{
    use HasFactory, SoftDeletes, QueryScopes;

    protected $fillable = [
        'image',
        'publish',
        'order',
        'user_id',
    ];

    protected $table = 'achievements';

    public function languages(){
        return $this->belongsToMany(Language::class, 'achievement_language' , 'achievement_id', 'language_id')
        ->withPivot(
            'name',
            'description'
        )->withTimestamps();
    }
}
