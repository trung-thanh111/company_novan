<?php

namespace App\Repositories;

use App\Models\ProjectCatalogue;
use App\Repositories\Interfaces\ProjectCatalogueRepositoryInterface;

/**
 * Class ProjectCatalogueRepository
 * @package App\Repositories
 */
class ProjectCatalogueRepository extends BaseRepository implements ProjectCatalogueRepositoryInterface
{
    protected $model;

    public function __construct(
        ProjectCatalogue $model
    ){
        $this->model = $model;
        parent::__construct($model);
    }
    public function getProjectCatalogueById(int $id = 0, int $language_id = 0){
        return $this->model->select([
                'project_catalogues.id',
                'project_catalogues.parent_id',
                'project_catalogues.lft',
                'project_catalogues.rgt',
                'project_catalogues.level',
                'project_catalogues.image',
                'project_catalogues.icon',
                'project_catalogues.publish',
                'project_catalogues.order',
                'tb2.name',
                'tb2.description',
                'tb2.content',
                'tb2.meta_title',
                'tb2.meta_keyword',
                'tb2.meta_description',
                'tb2.canonical',
            ]
        )
        ->leftJoin(\Illuminate\Support\Facades\DB::raw('(SELECT project_catalogue_id, name, description, content, meta_title, meta_keyword, meta_description, canonical FROM project_catalogue_language WHERE language_id = '.(int)$language_id.') as tb2'), 'tb2.project_catalogue_id', '=', 'project_catalogues.id')
        ->find($id);
    }

    public function breadcrumb($model, $language){
        if (!$model) return [];
        return $this->model->select('id', 'lft', 'rgt', 'level')
            ->where('lft', '<=', $model->lft)
            ->where('rgt', '>=', $model->rgt)
            ->with(['languages' => function($query) use ($language){
                $query->where('language_id', $language);
            }])
            ->orderBy('lft', 'ASC')
            ->get();
    }
}
