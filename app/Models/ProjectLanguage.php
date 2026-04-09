<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectLanguage extends Model
{
    use HasFactory;

    protected $table = 'project_language';

    protected $fillable = [
        'project_id',
        'language_id',
        'name',
        'canonical',
        'description',
        'content',
        'meta_title',
        'meta_keyword',
        'meta_description',
    ];

    public function projects(){
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
}
