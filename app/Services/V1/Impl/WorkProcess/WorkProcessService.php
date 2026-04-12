<?php

namespace App\Services\V1\Impl\WorkProcess;

use App\Services\V2\BaseService;
use App\Services\V1\Interfaces\WorkProcess\WorkProcessServiceInterface;
use App\Repositories\Interfaces\WorkProcess\WorkProcessRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/**
 * Class WorkProcessService
 * @package App\Services\V1\Impl\WorkProcess
 */
class WorkProcessService extends BaseService implements WorkProcessServiceInterface
{
    protected $repository;
    protected $language;
    protected $perpage = 20;

    public function __construct(
        WorkProcessRepositoryInterface $repository
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

    /**
     * V2 Pagination compatible with BaseService
     */
    public function pagination(Request $request)
    {
        $perPage = $request->integer('perpage') ?? $this->perpage;
        $param = [
            'keyword' => addslashes($request->input('keyword')),
            'publish' => $request->integer('publish'),
            'perpage' => $perPage,
            'language_id' => $this->language,
        ];

        return $this->repository->getWorkProcessByCondition([], false, [], ['order', 'asc'], $param);
    }

    /**
     * V1 Paginate (legacy call support)
     */
    public function paginate($request, $languageId)
    {
        return $this->pagination($request);
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
        return $this->repository->getWorkProcessById($id, $this->language);
    }

    public function findByCondition($condition = [], $flag = false, $relation = [], $orderBy = ['id', 'desc'], $param = [], $withCount = [])
    {
        $languageId = 1;
        foreach ($condition as $key => $val) {
            if ($val[0] == 'language_id') {
                $languageId = $val[2];
                unset($condition[$key]);
            }
        }

        $param['language_id'] = $languageId;
        // If flag is true, we might want all records for a section
        if ($flag) {
            $param['perpage'] = 100; // Get all if flagged
        }

        return $this->repository->getWorkProcessByCondition(
            $condition,
            $flag,
            $relation,
            $orderBy,
            $param,
            $withCount
        );
    }

    /**
     * Prepare data for V2 save() method
     */
    protected function prepareModelData(): static
    {
        $request = $this->context['request'] ?? null;
        if (!is_null($request)) {
            $this->modelData = $request->only(['image', 'publish', 'order']);
            $this->modelData['user_id'] = Auth::id();
        }
        return $this;
    }

    /**
     * Post-save logic for V2 save() method (handling pivot)
     */
    public function afterSave(): static
    {
        parent::afterSave();
        $request = $this->context['request'] ?? null;
        if (!is_null($request) && isset($this->model)) {
            $languageId = $this->language;
            $payloadLanguage = [
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'content' => $request->input('content'),
            ];

            $this->model->languages()->detach($languageId);
            $this->repository->createPivot($this->model, $payloadLanguage, 'languages', $languageId);
        }
        return $this;
    }
}
