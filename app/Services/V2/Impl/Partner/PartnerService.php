<?php

namespace App\Services\V2\Impl\Partner;

use App\Services\V2\BaseService;
use App\Services\V2\Interfaces\Partner\PartnerServiceInterface;
use App\Repositories\Interfaces\PartnerRepositoryInterface;
use Illuminate\Support\Facades\Auth;

/**
 * Class PartnerService
 * @package App\Services\V2\Impl\Partner
 */
class PartnerService extends BaseService implements PartnerServiceInterface
{
    protected $repository;
    protected $fillable;
    protected $with = ['languages'];
    protected $language;

    public function __construct(
        PartnerRepositoryInterface $repository
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
        $orderBy = ['partners.id', 'DESC'];
        $join = [
            ['partner_language as tb2', 'tb2.partner_id', '=', 'partners.id'],
        ];
        
        $records = $this->repository->pagination(
            [
                'partners.id',
                'partners.publish',
                'partners.image',
                'partners.order',
                'partners.link',
                'partners.created_at',
                'tb2.name',
            ],
            $condition,
            $perPage,
            ['path' => 'partner/index'],
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
        $payload = $request->only(['name', 'description']);
        $payload['language_id'] = $languageId;
        $payload['partner_id'] = $this->model->id;

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
        return $this->repository->getPartnerById($id, $this->language);
    }
}
