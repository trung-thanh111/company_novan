<?php

namespace App\Services\V2\Impl\Faq;

use App\Services\V2\BaseService;
use App\Services\V2\Interfaces\Faq\FaqCatalogueServiceInterface;
use App\Repositories\Interfaces\FaqCatalogueRepositoryInterface;
use Illuminate\Support\Facades\Auth;

/**
 * Class FaqCatalogueService
 * @package App\Services\V2\Impl\Faq
 */
class FaqCatalogueService extends BaseService implements FaqCatalogueServiceInterface
{
    protected $repository;
    protected $fillable;
    protected $with = ['languages'];
    protected $language;

    public function __construct(
        FaqCatalogueRepositoryInterface $repository
    ) {
        $this->repository = $repository;
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
        $orderBy = ['faq_catalogues.lft', 'ASC'];
        $join = [
            ['faq_catalogue_language as tb2', 'tb2.faq_catalogue_id', '=', 'faq_catalogues.id'],
        ];
        
        $records = $this->repository->pagination(
            [
                'faq_catalogues.id',
                'faq_catalogues.publish',
                'faq_catalogues.image',
                'faq_catalogues.level',
                'faq_catalogues.order',
                'faq_catalogues.created_at',
                'tb2.name',
                'tb2.canonical',
            ],
            $condition,
            $perPage,
            ['path' => 'faq/catalogue/index', 'groupBy' => ['faq_catalogues.id']],
            $orderBy,
            $join
        );
        return $records;
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
        $payload['faq_catalogue_id'] = $this->model->id;

        $this->model->languages()->detach($languageId);
        $this->repository->createPivot($this->model, $payload, 'languages', $languageId);
    }

    public function create($request, $languageId)
    {
        return $this->save($request, 'store');
    }

    public function update($id, $request, $languageId)
    {
        return $this->save($request, 'update', $id);
    }

    public function findById($id){
        return $this->repository->getFaqCatalogueById($id, $this->language);
    }
}
