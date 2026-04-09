<?php

namespace App\Services\V2\Impl\Faq;

use App\Services\V2\BaseService;
use App\Services\V2\Interfaces\Faq\FaqServiceInterface;
use App\Repositories\Interfaces\FaqRepositoryInterface;
use Illuminate\Support\Facades\Auth;

/**
 * Class FaqService
 * @package App\Services\V2\Impl\Faq
 */
class FaqService extends BaseService implements FaqServiceInterface
{
    protected $repository;
    protected $fillable;
    protected $with = ['languages'];
    protected $language;

    public function __construct(
        FaqRepositoryInterface $repository
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
        $orderBy = ['faqs.id', 'DESC'];
        $join = [
            ['faq_language as tb2', 'tb2.faq_id', '=', 'faqs.id'],
            ['faq_catalogue_faq as tb3', 'faqs.id', '=', 'tb3.faq_id'],
        ];
        
        $records = $this->repository->pagination(
            [
                'faqs.id',
                'faqs.publish',
                'faqs.image',
                'faqs.order',
                'faqs.created_at',
                'tb2.name',
                'tb2.canonical',
            ],
            $condition,
            $perPage,
            ['path' => 'faq/index', 'groupBy' => ['faqs.id']],
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
            $this->withRelation();
        }
        return $this;
    }

    protected function updateLanguage($request)
    {
        $languageId = $this->language;
        $payload = $request->only(['name', 'description', 'content', 'meta_title', 'meta_keyword', 'meta_description', 'canonical']);
        $payload['language_id'] = $languageId;
        $payload['faq_id'] = $this->model->id;

        $this->model->languages()->detach($languageId);
        $this->repository->createPivot($this->model, $payload, 'languages', $languageId);
    }

    protected function withRelation(): static
    {
        $request = $this->context['request'];
        $catalogue = $request->input('catalogue', []);
        $faqCatalogueId = $request->input('faq_catalogue_id');
        if ($faqCatalogueId) {
            $catalogue[] = (string)$faqCatalogueId;
        }
        $catalogue = array_unique($catalogue);
        if (count($catalogue)) {
            $this->model->faq_catalogues()->sync($catalogue);
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

    public function findById($id){
        return $this->repository->getFaqById($id, $this->language);
    }
}
