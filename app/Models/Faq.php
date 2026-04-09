<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\QueryScopes;

class Faq extends Model
{
    use HasFactory, SoftDeletes, QueryScopes;

    protected $fillable = [
        'image',
        'album',
        'publish',
        'order',
        'user_id',
    ];

    protected $table = 'faqs';

    public function languages(){
        return $this->belongsToMany(Language::class, 'faq_language' , 'faq_id', 'language_id')
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

    public function faq_catalogues(){
        return $this->belongsToMany(FaqCatalogue::class, 'faq_catalogue_faq' , 'faq_id', 'faq_catalogue_id');
    }

    public function getRelationable(){
        return ['faq_catalogues'];
    }
}
