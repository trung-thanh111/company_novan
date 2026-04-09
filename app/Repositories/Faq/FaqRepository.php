<?php

namespace App\Repositories\Faq;

use App\Models\Faq;
use App\Repositories\Interfaces\FaqRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class FaqRepository
 * @package App\Repositories
 */
class FaqRepository extends BaseRepository implements FaqRepositoryInterface
{
    protected $model;

    public function __construct(
        Faq $model
    ){
        $this->model = $model;
    }

    public function getFaqById(int $id = 0, $language_id = 1){
        return $this->model->select([
                'faqs.id',
                'faqs.publish',
                'faqs.image',
                'faqs.order',
                'tb2.name',
                'tb2.description',
                'tb2.content',
                'tb2.meta_title',
                'tb2.meta_keyword',
                'tb2.meta_description',
                'tb2.canonical',
            ]
        )
        ->join('faq_language as tb2', 'tb2.faq_id', '=', 'faqs.id')
        ->with('faq_catalogues')
        ->where('tb2.language_id', $language_id)
        ->find($id);
    }

}
