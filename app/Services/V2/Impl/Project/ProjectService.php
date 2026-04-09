<?php

namespace App\Services\V2\Impl\Project;

use App\Services\V2\BaseService;
use App\Services\V2\Interfaces\Project\ProjectServiceInterface;
use App\Repositories\Interfaces\ProjectRepositoryInterface;
use App\Repositories\Interfaces\RouterRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Class ProjectService
 * @package App\Services\V2\Impl\Project
 */
class ProjectService extends BaseService implements ProjectServiceInterface
{
    protected $repository;
    protected $routerRepository;
    protected $language;

    public function __construct(
        ProjectRepositoryInterface $repository,
        RouterRepositoryInterface $routerRepository
    ) {
        $this->repository = $repository;
        $this->routerRepository = $routerRepository;
        parent::__construct($repository);
        $this->language = $this->currentLanguage();
    }

    private function currentLanguage() {
        $locale = app()->getLocale();
        $language = \App\Models\Language::where('canonical', $locale)->first();
        return $language->id ?? 1;
    }

    public function pagination($request){
        $perPage = $request->integer('perpage');
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'publish' => $request->integer('publish'),
            'where' => [],
        ];
        
        $projectCatalogueId = $request->integer('project_catalogue_id');
        if($projectCatalogueId > 0){
            $condition['where'][] = ['projects.project_catalogue_id', '=', $projectCatalogueId];
        }

        $orderBy = ['projects.id', 'DESC'];
        $join = [
            ['(SELECT project_id, name, canonical FROM project_language WHERE language_id = '.$this->language.') as tb2', 'tb2.project_id', '=', 'projects.id', 'left'],
            ['(SELECT project_catalogue_id, name FROM project_catalogue_language WHERE language_id = '.$this->language.') as tb3', 'tb3.project_catalogue_id', '=', 'projects.project_catalogue_id', 'left'],
        ];
        
        $projects = $this->repository->pagination(
            [
                'projects.id',
                'projects.publish',
                'projects.is_featured',
                'projects.follow',
                'projects.image',
                'projects.order',
                'projects.value',
                'projects.scale',
                'projects.status',
                'projects.created_at',
                'tb2.name',
                'tb2.canonical',
                'tb3.name as catalogue_name',
            ],
            $condition,
            $perPage,
            ['path' => 'project/index', 'groupBy' => ['projects.id']],
            $orderBy,
            $join
        );

        return $projects;
    }

    public function prepareModelData(): static
    {
        $request = $this->context['request'] ?? null;
        if (!is_null($request)) {
            $fillable = $this->repository->getFillable();
            $this->modelData = $request->only($fillable);
            $this->modelData['user_id'] = Auth::id();
            if ($request->has('value')) {
                $this->modelData['value'] = str_replace(['.', ','], '', $request->input('value'));
            } else {
                $this->modelData['value'] = 0;
            }
            
            if($request->has('album')){
                $this->modelData['album'] = json_encode($request->input('album'));
            }

            if($request->has('params')){
                $this->modelData['params'] = $request->input('params');
            }
        }
        return $this;
    }

    public function afterSave(): static
    {
        parent::afterSave();
        $request = $this->context['request'] ?? null;
        if (!is_null($request)) {
            $this->updateLanguage($request);
            $this->withRelation();
            $this->updateRouter($this->model, $request, $this->language);
        }
        return $this;
    }

    protected function updateLanguage($request)
    {
        $languageId = $this->language;
        $payload = $request->only(['name', 'description', 'content', 'meta_title', 'meta_keyword', 'meta_description', 'canonical']);
        $payload['language_id'] = $languageId;
        $payload['project_id'] = $this->model->id;

        $this->model->languages()->detach($languageId);
        $this->repository->createPivot($this->model, $payload, 'languages', $languageId);
    }

    protected function withRelation(): static
    {
        return $this;
    }

    private function updateRouter($model, $request, $languageId){
        $payload = [
            'canonical' => $request->input('canonical'),
            'module_id' => $model->id,
            'language_id' => $languageId,
            'controllers' => 'App\Http\Controllers\Frontend\ProjectController',
        ];
        $this->routerRepository->forceDeleteByCondition([
            ['module_id', '=', $model->id],
            ['language_id', '=', $languageId],
            ['controllers', '=', 'App\Http\Controllers\Frontend\ProjectController'],
        ]);
        $this->routerRepository->create($payload);
    }

    public function create($request, $languageId)
    {
        DB::beginTransaction();
        try {
            $project = $this->save($request, 'store');
            DB::commit();
            return $project;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update($id, $request, $languageId)
    {
        DB::beginTransaction();
        try {
            $project = $this->save($request, 'update', $id);
            DB::commit();
            return $project;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function findById($id){
        return $this->repository->getProjectById($id, $this->language);
    }
}
