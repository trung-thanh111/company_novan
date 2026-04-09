<?php

namespace App\Services\V1\Impl\CoreValue;

use App\Repositories\CoreValue\CoreValueRepositoryInterface;
use App\Services\V1\Interfaces\CoreValue\CoreValueServiceInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class CoreValueService
 * @package App\Services\V1\Impl\CoreValue
 */
class CoreValueService implements CoreValueServiceInterface
{
    protected $coreValueRepository;

    public function __construct(
        CoreValueRepositoryInterface $coreValueRepository
    ) {
        $this->coreValueRepository = $coreValueRepository;
    }

    public function paginate($request, $languageId)
    {
        $condition['keyword'] = addslashes($request->input('keyword'));
        $condition['publish'] = $request->integer('publish');
        $perPage = $request->integer('perpage');

        $coreValues = $this->coreValueRepository->getCoreValueByCondition(
            [], false, ['languages' => function($query) use ($languageId) {
                $query->where('language_id', $languageId);
            }], ['id', 'desc'], ['perpage' => $perPage, 'keyword' => $condition['keyword'], 'publish' => $condition['publish']]
        );

        return $coreValues;
    }

    public function create($request, $languageId)
    {
        DB::beginTransaction();
        try {
            $payload = $request->only(['image', 'publish', 'order']);
            $payload['user_id'] = auth()->id();
            
            $coreValue = $this->coreValueRepository->create($payload);

            if ($coreValue->id > 0) {
                $payloadLanguage = [
                    'name' => $request->input('name'),
                    'description' => $request->input('description'),
                    'content' => $request->input('content'),
                ];
                $this->coreValueRepository->createPivot($coreValue, $payloadLanguage, 'languages', $languageId);
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return false;
        }
    }

    public function update($id, $request, $languageId)
    {
        DB::beginTransaction();
        try {
            $coreValue = $this->coreValueRepository->findById($id);

            $payload = $request->only(['image', 'publish', 'order']);
            $this->coreValueRepository->update($id, $payload);

            $payloadLanguage = [
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'content' => $request->input('content'),
            ];
            
            $coreValue->languages()->detach($languageId);
            $this->coreValueRepository->createPivot($coreValue, $payloadLanguage, 'languages', $languageId);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return false;
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $coreValue = $this->coreValueRepository->findById($id);
            $coreValue->languages()->detach();
            $this->coreValueRepository->delete($id);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return false;
        }
    }

    public function updateStatus($post = [])
    {
        DB::beginTransaction();
        try {
            $payload[$post['field']] = (($post['value'] == 1) ? 2 : 1);
            $coreValue = $this->coreValueRepository->update($post['modelId'], $payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return false;
        }
    }

    public function updateStatusAll($post = [])
    {
        DB::beginTransaction();
        try {
            $payload[$post['field']] = $post['value'];
            $coreValues = $this->coreValueRepository->updateByWhereIn('id', $post['id'], $payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return false;
        }
    }

    public function findByCondition($condition = [], $flag = false, $relation = [], $orderBy = ['id', 'desc'], $param = [])
    {
        $languageId = 1;
        foreach($condition as $key => $val){
            if($val[0] == 'language_id'){
                $languageId = $val[2];
                unset($condition[$key]);
            }
        }
        
        $relation = array_merge(['languages' => function($query) use ($languageId) {
            $query->where('language_id', $languageId);
        }], $relation);

        return $this->coreValueRepository->getCoreValueByCondition(
            $condition, $flag, $relation, $orderBy, $param
        );
    }
}
