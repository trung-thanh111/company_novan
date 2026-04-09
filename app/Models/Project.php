<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\QueryScopes;

class Project extends Model
{
    use HasFactory, SoftDeletes, QueryScopes;

    protected $fillable = [
        'project_catalogue_id',
        'image',
        'album',
        'publish',
        'is_featured',
        'follow',
        'order',
        'user_id',
        'value',
        'scale',
        'location',
        'map',
        'customer',
        'status',
        'amenities',
        'video_url',
        'brochure',
        'start_date',
        'end_date',
        'params',
    ];

    protected $casts = [
        'params' => 'json',
    ];

    protected $table = 'projects';

    public function languages(){
        return $this->belongsToMany(Language::class, 'project_language' , 'project_id', 'language_id')
        ->withPivot(
            'name',
            'canonical',
            'meta_title',
            'meta_keyword',
            'meta_description',
            'description',
            'content'
        )->withTimestamps();
    }

    public function project_catalogue(){
        return $this->belongsTo(ProjectCatalogue::class, 'project_catalogue_id', 'id');
    }

    public function project_language(){
        return $this->hasMany(ProjectLanguage::class, 'project_id', 'id');
    }

    public function getRelationable(){
        return [];
    }
}
