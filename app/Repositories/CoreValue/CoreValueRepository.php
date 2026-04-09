<?php

namespace App\Repositories\CoreValue;

use App\Models\CoreValue;
use App\Repositories\BaseRepository;
use App\Repositories\CoreValue\CoreValueRepositoryInterface;

/**
 * Class CoreValueRepository
 * @package App\Repositories\CoreValue
 */
class CoreValueRepository extends BaseRepository implements CoreValueRepositoryInterface
{
    /**
     * @var CoreValue
     */
    protected $model;

    /**
     * CoreValueRepository constructor.
     *
     * @param CoreValue $model
     */
    public function __construct(CoreValue $model)
    {
        $this->model = $model;
    }

    public function getCoreValueByCondition(
        array $condition = [],
        bool $flag = false,
        array $relation = [],
        array $orderBy = ['id', 'desc'],
        array $param = [],
        array $withCount = []
    ) {
        $query = $this->model->newQuery();
        
        // Add relationships
        if (!empty($relation)) {
            $query->with($relation);
        }

        // Add scope filters
        $query->keyword($param['keyword'] ?? null)
              ->publish($param['publish'] ?? null)
              ->customDropdownFilter($param['filter'] ?? []);

        if (!empty($withCount)) {
            $query->withCount($withCount);
        }

        // Add where clauses
        if (!empty($condition)) {
            foreach ($condition as $key => $val) {
                $query->where($val[0], $val[1], $val[2]);
            }
        }

        // Add order by
        if (!empty($orderBy)) {
            $query->orderBy($orderBy[0], $orderBy[1]);
        }

        return $query->paginate($param['perpage'] ?? 20);
    }
}
