<?php

namespace App\Repositories\Company;

use App\Models\Service;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\ServiceRepositoryInterface;

/**
 * Class ServiceRepository
 * @package App\Repositories\Company
 */
class ServiceRepository extends BaseRepository implements ServiceRepositoryInterface
{
    protected $model;

    public function __construct(
        Service $model
    ){
        $this->model = $model;
        parent::__construct($model);
    }

    public function getServiceById(int $id = 0, int $language_id = 0){
        return $this->model->select([
                'services.id',
                'services.image',
                'services.album',
                'services.publish',
                'services.order',
                'services.price',
                'services.created_at',
                'tb2.name',
                'tb2.description',
                'tb2.content',
                'tb2.meta_title',
                'tb2.meta_keyword',
                'tb2.meta_description',
                'tb2.canonical',
            ]
        )
        ->join('service_language as tb2', 'tb2.service_id', '=','services.id')
        ->where('tb2.language_id', '=', $language_id)
        ->with(['service_catalogues'])
        ->find($id);
    }
}
