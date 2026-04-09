<?php

namespace App\Services\V2\Impl\Company;

use App\Services\V2\BaseService;
use App\Services\V2\Interfaces\Company\ServiceCatalogueServiceInterface;
use App\Repositories\Interfaces\ServiceCatalogueRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Language;

/**
 * Class ServiceCatalogueService
 * @package App\Services\V2\Impl\Company
 */
class ServiceCatalogueService extends BaseService implements ServiceCatalogueServiceInterface
{
    protected $repository;
    protected $fillable;
    protected $with = ['languages'];
    protected $language;

    public function __construct(
        ServiceCatalogueRepositoryInterface $repository
    ) {
        $this->repository = $repository;
        parent::__construct($repository);
        $this->language = $this->currentLanguage();
    }

    private function currentLanguage() {
        $locale = app()->getLocale();
        $language = Language::where('canonical', $locale)->first();
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
        $orderBy = ['service_catalogues.lft', 'ASC'];
        $join = [
            ['service_catalogue_language as tb2', 'tb2.service_catalogue_id', '=', 'service_catalogues.id'],
        ];
        $serviceCatalogues = $this->repository->pagination(
            [
                'service_catalogues.id',
                'service_catalogues.parent_id',
                'service_catalogues.publish',
                'service_catalogues.image',
                'service_catalogues.level',
                'service_catalogues.order',
                'tb2.name',
                'tb2.canonical',
            ],
            $condition,
            $perPage,
            ['path' => 'service/catalogue/index'],
            $orderBy,
            $join
        );
        return $serviceCatalogues;
    }

    public function save($request, $action = 'store', $id = null){
        DB::beginTransaction();
        try{
            $payload = $request->only(['parent_id', 'image', 'publish', 'order']);
            if($action == 'store'){
                $model = $this->repository->create($payload);
            }else{
                $model = $this->repository->update($id, $payload);
            }

            if($model->id > 0){
                $this->updateLanguage($model, $request);
            }
            DB::commit();
            return true;
        }catch(\Exception $e){
            DB::rollBack();
            return false;
        }
    }

    public function destroy($id){
        DB::beginTransaction();
        try{
            $this->repository->delete($id);
            DB::commit();
            return true;
        }catch(\Exception $e){
            DB::rollBack();
            return false;
        }
    }

    private function updateLanguage($model, $request){
        $payload = $request->only(['name', 'canonical', 'description', 'content', 'meta_title', 'meta_keyword', 'meta_description']);
        $payload['language_id'] = $this->language;
        $payload['service_catalogue_id'] = $model->id;
        $model->languages()->detach($this->language);
        return $this->repository->createPivot($model, $payload, 'languages');
    }

    public function findById($id){
        return $this->repository->getServiceCatalogueById($id, $this->language);
    }

    public function prepareModelData(): static
    {
        $request = $this->context['request'] ?? null;
        if (!is_null($request)) {
            $this->fillable = $this->repository->getFillable();
            $this->modelData = $request->only($this->fillable);
            $this->modelData['user_id'] = Auth::id();
        }
        return $this;
    }

    public function afterSave(): static
    {
        parent::afterSave();
        $request = $this->context['request'] ?? null;
        if (!is_null($request) && isset($this->context['action'])) {
            $this->updateLanguage($this->model, $request);
        }
        return $this;
    }

    public function create($request, $languageId)
    {
        return $this->save($request, 'store');
    }

    public function update($id, $request, $languageId)
    {
        return $this->save($request, 'update', $id);
    }
}
