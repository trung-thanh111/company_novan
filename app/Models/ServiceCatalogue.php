<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\QueryScopes;

class ServiceCatalogue extends Model
{
    use HasFactory, SoftDeletes, QueryScopes;

    protected $fillable = [
        'parent_id',
        'lft',
        'rgt',
        'level',
        'image',
        'icon',
        'album',
        'publish',
        'order',
        'user_id',
    ];

    protected $table = 'service_catalogues';

    public function languages(){
        return $this->belongsToMany(Language::class, 'service_catalogue_language' , 'service_catalogue_id', 'language_id')
        ->withPivot(
            'service_catalogue_id',
            'language_id',
            'name',
            'canonical',
            'meta_title',
            'meta_keyword',
            'meta_description',
            'description',
            'content'
        )->withTimestamps();
    }

    public function services(){
        return $this->belongsToMany(Service::class, 'service_catalogue_service' , 'service_catalogue_id', 'service_id');
    }

    public function service_catalogue_language(){
        return $this->hasMany(ServiceCatalogueLanguage::class, 'service_catalogue_id', 'id');
    }

    public function getRelationable(){
        return [];
    }

    public static function isNodeCheck($id = 0){
        $node = self::find($id);
        if(!$node) return true;
        
        if($node->rgt - $node->lft !== 1){
            return false;
        } 

        return true;
    }

    public function direct_children(){
        return $this->hasMany(ServiceCatalogue::class, 'parent_id', 'id');
    }
}
