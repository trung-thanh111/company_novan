<?php

namespace App\Services\V2\Impl\Project;

use App\Services\V2\BaseService;
use App\Services\V2\Interfaces\Project\ProjectCatalogueServiceInterface;
use App\Repositories\Interfaces\ProjectCatalogueRepositoryInterface;
use App\Repositories\Interfaces\RouterRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class ProjectCatalogueService
 * @package App\Services\V2\Impl\Project
 */
class ProjectCatalogueService extends BaseService implements ProjectCatalogueServiceInterface
{
    protected $repository;
    protected $routerRepository;
    protected $language;

    public function __construct(
        ProjectCatalogueRepositoryInterface $repository,
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
            'where' => [
                ['tb2.language_id', '=', $this->language],
            ],
        ];
        $orderBy = ['project_catalogues.lft', 'ASC'];
        $join = [
            ['project_catalogue_language as tb2', 'tb2.project_catalogue_id', '=', 'project_catalogues.id'],
        ];
        
        $projectCatalogues = $this->repository->pagination(
            [
                'project_catalogues.id',
                'project_catalogues.publish',
                'project_catalogues.image',
                'project_catalogues.level',
                'project_catalogues.order',
                'tb2.name',
                'tb2.canonical',
            ],
            $condition,
            $perPage,
            ['path' => 'project/catalogue/index'],
            $orderBy,
            $join
        );
        return $projectCatalogues;
    }

    public function prepareModelData(): static
    {
        $request = $this->context['request'] ?? null;
        if (!is_null($request)) {
            $fillable = $this->repository->getFillable();
            $this->modelData = $request->only($fillable);
            $this->modelData['user_id'] = Auth::id();
            if($request->has('album')){
                $this->modelData['album'] = json_encode($request->input('album'));
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
            $this->updateRouter($this->model, $request, $this->language);
        }
        return $this;
    }

    protected function updateLanguage($request)
    {
        $languageId = $this->language;
        $payload = $request->only(['name', 'description', 'content', 'meta_title', 'meta_keyword', 'meta_description', 'canonical']);
        $payload['language_id'] = $languageId;
        $payload['project_catalogue_id'] = $this->model->id;

        $this->model->languages()->detach($languageId);
        $this->repository->createPivot($this->model, $payload, 'languages');
    }

    private function updateRouter($model, $request, $languageId){
        $payload = [
            'canonical' => $request->input('canonical'),
            'module_id' => $model->id,
            'language_id' => $languageId,
            'controllers' => 'App\Http\Controllers\Frontend\ProjectCatalogueController',
        ];
        $this->routerRepository->forceDeleteByCondition([
            ['module_id', '=', $model->id],
            ['language_id', '=', $languageId],
            ['controllers', '=', 'App\Http\Controllers\Frontend\ProjectCatalogueController'],
        ]);
        $this->routerRepository->create($payload);
    }

    public function create($request, $languageId)
    {
        DB::beginTransaction();
        try {
            $catalogue = $this->save($request, 'store');
            DB::commit();
            return $catalogue;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update($id, $request, $languageId)
    {
        DB::beginTransaction();
        try {
            $catalogue = $this->save($request, 'update', $id);
            DB::commit();
            return $catalogue;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function findById($id){
        return $this->repository->findByCondition([
            ['project_catalogues.id', '=', $id],
            ['tb2.language_id', '=', $this->language]
        ], true, [
            ['project_catalogue_language as tb2', 'tb2.project_catalogue_id', '=', 'project_catalogues.id']
        ]);
    }
}
