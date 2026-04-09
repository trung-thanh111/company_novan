<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\QueryScopes;

class FaqCatalogue extends Model
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

    protected $table = 'faq_catalogues';

    public function languages(){
        return $this->belongsToMany(Language::class, 'faq_catalogue_language' , 'faq_catalogue_id', 'language_id')
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

    public function faqs(){
        return $this->belongsToMany(Faq::class, 'faq_catalogue_faq' , 'faq_catalogue_id', 'faq_id');
    }

    public static function isNodeCheck($id = 0){
        $faqCatalogue = FaqCatalogue::find($id);
        if($faqCatalogue->rgt - $faqCatalogue->lft !== 1){
            return false;
        }
        return true;
    }

    public function getRelationable(){
        return ['faqs'];
    }

}
