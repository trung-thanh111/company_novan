<?php

namespace App\Services\V2\Impl\Company;

use App\Services\V2\BaseService;

use App\Services\V2\Interfaces\Company\ServiceServiceInterface;
use App\Repositories\Interfaces\ServiceRepositoryInterface;
use Illuminate\Support\Facades\Auth;

/**
 * Class ServiceService
 * @package App\Services\V2\Impl\Company
 */
class ServiceService extends BaseService implements ServiceServiceInterface
{
    protected $repository;
    protected $fillable;
    protected $with = ['languages'];
    protected $language;

    public function __construct(
        ServiceRepositoryInterface $repository
    ) {
        $this->repository = $repository;
        parent::__construct($repository);
        $this->language = $this->currentLanguage();
    }

    private function currentLanguage()
    {
        $locale = app()->getLocale();
        $language = \App\Models\Language::where('canonical', $locale)->first();
        return $language->id ?? 1;
    }

    public function pagination($request)
    {
        $perPage = $request->integer('perpage');
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'publish' => $request->integer('publish'),
            'where' => [
                ['tb2.language_id', '=', $this->language],
            ],
        ];
        $orderBy = ['services.id', 'DESC'];
        $join = [
            ['service_language as tb2', 'tb2.service_id', '=', 'services.id'],
            ['service_catalogue_service as tb3', 'services.id', '=', 'tb3.service_id'],
        ];

        $services = $this->repository->pagination(
            [
                'services.id',
                'services.publish',
                'services.image',
                'services.order',
                'services.price',
                'services.created_at',
                'tb2.name',
                'tb2.canonical',
            ],
            $condition,
            $perPage,
            ['path' => 'service/index', 'groupBy' => ['services.id']],
            $orderBy,
            $join
        );
        return $services;
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
            $this->updateLanguage($request);
        }
        return $this;
    }

    protected function updateLanguage($request)
    {
        $languageId = $this->language;
        $payload = $request->only(['name', 'description', 'content', 'meta_title', 'meta_keyword', 'meta_description', 'canonical']);
        $payload['language_id'] = $languageId;
        $payload['service_id'] = $this->model->id;

        $this->model->languages()->detach($languageId);
        $this->repository->createPivot($this->model, $payload, 'languages');
    }

    protected function withRelation(): static
    {
        $request = $this->context['request'];
        $catalogue = $request->input('catalogue', []);
        $serviceCatalogueId = $request->input('service_catalogue_id');
        if ($serviceCatalogueId) {
            $catalogue[] = (string)$serviceCatalogueId;
        }
        $catalogue = array_unique($catalogue);
        if (count($catalogue)) {
            $this->model->service_catalogues()->sync($catalogue);
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

    public function findById($id)
    {
        return $this->repository->getServiceById($id, $this->language);
    }
}
