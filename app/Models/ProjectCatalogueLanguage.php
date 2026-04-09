<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectCatalogueLanguage extends Model
{
    use HasFactory;

    protected $table = 'project_catalogue_language';

    protected $fillable = [
        'project_catalogue_id',
        'language_id',
        'name',
        'canonical',
        'description',
        'content',
        'meta_title',
        'meta_keyword',
        'meta_description',
    ];

    public function project_catalogues(){
        return $this->belongsTo(ProjectCatalogue::class, 'project_catalogue_id', 'id');
    }
}
