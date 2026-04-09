<?php

namespace App\Repositories;

use App\Models\Project;
use App\Repositories\Interfaces\ProjectRepositoryInterface;

/**
 * Class ProjectRepository
 * @package App\Repositories
 */
class ProjectRepository extends BaseRepository implements ProjectRepositoryInterface
{
    protected $model;

    public function __construct(
        Project $model
    ){
        $this->model = $model;
        parent::__construct($model);
    }

    public function getProjectById(int $id = 0, int $language_id = 0){
        return $this->model->select([
                'projects.id',
                'projects.project_catalogue_id',
                'projects.is_featured',
                'projects.follow',
                'projects.image',
                'projects.album',
                'projects.publish',
                'projects.order',
                'projects.value',
                'projects.scale',
                'projects.location',
                'projects.map',
                'projects.customer',
                'projects.status',
                'projects.amenities',
                'projects.video_url',
                'projects.brochure',
                'projects.start_date',
                'projects.end_date',
                'projects.params',
                'projects.created_at',
                'tb2.name',
                'tb2.description',
                'tb2.content',
                'tb2.meta_title',
                'tb2.meta_keyword',
                'tb2.meta_description',
                'tb2.canonical',
            ]
        )
        ->leftJoin(\Illuminate\Support\Facades\DB::raw('(SELECT project_id, name, description, content, meta_title, meta_keyword, meta_description, canonical FROM project_language WHERE language_id = '.$language_id.') as tb2'), 'tb2.project_id', '=', 'projects.id')
        ->with(['project_catalogue'])
        ->find($id);
    }
}
