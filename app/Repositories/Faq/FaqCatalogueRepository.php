<?php

namespace App\Repositories\Faq;

use App\Models\FaqCatalogue;
use App\Repositories\Interfaces\FaqCatalogueRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class FaqCatalogueRepository
 * @package App\Repositories
 */
class FaqCatalogueRepository extends BaseRepository implements FaqCatalogueRepositoryInterface
{
    protected $model;

    public function __construct(
        FaqCatalogue $model
    ){
        $this->model = $model;
    }

    public function getFaqCatalogueById(int $id = 0, $language_id = 1){
        return $this->model->select([
                'faq_catalogues.id',
                'faq_catalogues.parent_id',
                'faq_catalogues.lft',
                'faq_catalogues.rgt',
                'faq_catalogues.level',
                'faq_catalogues.image',
                'faq_catalogues.icon',
                'faq_catalogues.album',
                'faq_catalogues.publish',
                'faq_catalogues.order',
                'tb2.name',
                'tb2.description',
                'tb2.content',
                'tb2.meta_title',
                'tb2.meta_keyword',
                'tb2.meta_description',
                'tb2.canonical',
            ]
        )
        ->join('faq_catalogue_language as tb2', 'tb2.faq_catalogue_id', '=', 'faq_catalogues.id')
        ->where('tb2.language_id', $language_id)
        ->find($id);
    }

}
