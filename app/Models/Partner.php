<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\QueryScopes;

class Partner extends Model
{
    use HasFactory, SoftDeletes, QueryScopes;

    protected $fillable = [
        'image',
        'link',
        'publish',
        'order',
        'user_id',
    ];

    protected $relationable = [
       
    ];
    
    public function getRelationable(){
        return $this->relationable;
    }

    protected $table = 'partners';

    public function languages(){
        return $this->belongsToMany(Language::class, 'partner_language' , 'partner_id', 'language_id')
        ->withPivot(
            'name',
            'description'
        )->withTimestamps();
    }
}
