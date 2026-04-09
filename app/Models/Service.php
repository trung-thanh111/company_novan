<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\QueryScopes;

class Service extends Model
{
    use HasFactory, SoftDeletes, QueryScopes;

    protected $fillable = [
        'image',
        'album',
        'publish',
        'order',
        'user_id',
        'price',
        'service_catalogue_id',
    ];

    protected $table = 'services';

    public function languages(){
        return $this->belongsToMany(Language::class, 'service_language' , 'service_id', 'language_id')
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

    public function service_catalogues(){
        return $this->belongsToMany(ServiceCatalogue::class, 'service_catalogue_service' , 'service_id', 'service_catalogue_id');
    }

    public function service_language(){
        return $this->hasMany(ServiceLanguage::class, 'service_id', 'id');
    }

    public function getRelationable(){
        return ['service_catalogues'];
    }
}
