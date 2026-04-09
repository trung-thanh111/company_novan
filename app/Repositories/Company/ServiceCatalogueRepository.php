<?php

namespace App\Repositories\Company;

use App\Models\ServiceCatalogue;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\ServiceCatalogueRepositoryInterface;

/**
 * Class ServiceCatalogueRepository
 * @package App\Repositories\Company
 */
class ServiceCatalogueRepository extends BaseRepository implements ServiceCatalogueRepositoryInterface
{
    protected $model;

    public function __construct(
        ServiceCatalogue $model
    ){
        $this->model = $model;
        parent::__construct($model);
    }

    public function getServiceCatalogueById(int $id = 0, int $language_id = 0){
        return $this->model->select([
                'service_catalogues.id',
                'service_catalogues.parent_id',
                'service_catalogues.image',
                'service_catalogues.icon',
                'service_catalogues.album',
                'service_catalogues.publish',
                'service_catalogues.lft',
                'service_catalogues.rgt',
                'service_catalogues.order',
                'service_catalogues.created_at',
                'tb2.name',
                'tb2.description',
                'tb2.content',
                'tb2.meta_title',
                'tb2.meta_keyword',
                'tb2.meta_description',
                'tb2.canonical',
            ]
        )
        ->join('service_catalogue_language as tb2', 'tb2.service_catalogue_id', '=','service_catalogues.id')
        ->where('tb2.language_id', '=', $language_id)
        ->with(['direct_children.languages', 'services'])
        ->find($id);
    }
}
