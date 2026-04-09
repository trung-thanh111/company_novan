<?php

namespace App\Services\V2\Impl\Achievement;

use App\Services\V2\BaseService;
use App\Services\V2\Interfaces\Achievement\AchievementServiceInterface;
use App\Repositories\Interfaces\AchievementRepositoryInterface;
use Illuminate\Support\Facades\Auth;

/**
 * Class AchievementService
 * @package App\Services\V2\Impl\Achievement
 */
class AchievementService extends BaseService implements AchievementServiceInterface
{
    protected $repository;
    protected $fillable;
    protected $with = ['languages'];
    protected $language;

    public function __construct(
        AchievementRepositoryInterface $repository
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
        $orderBy = ['achievements.id', 'DESC'];
        $join = [
            ['achievement_language as tb2', 'tb2.achievement_id', '=', 'achievements.id'],
        ];
        
        $records = $this->repository->pagination(
            [
                'achievements.id',
                'achievements.publish',
                'achievements.image',
                'achievements.order',
                'achievements.created_at',
                'tb2.name',
            ],
            $condition,
            $perPage,
            ['path' => 'achievement/index'],
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
        $payload['achievement_id'] = $this->model->id;

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
        return $this->repository->getAchievementById($id, $this->language);
    }
}
