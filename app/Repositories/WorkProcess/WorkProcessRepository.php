<?php

namespace App\Repositories\WorkProcess;

use App\Models\WorkProcess;
use App\Repositories\Interfaces\WorkProcess\WorkProcessRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class WorkProcessRepository
 * @package App\Repositories\WorkProcess
 */
class WorkProcessRepository extends BaseRepository implements WorkProcessRepositoryInterface
{
    /**
     * @var WorkProcess
     */
    protected $model;

    /**
     * WorkProcessRepository constructor.
     *
     * @param WorkProcess $model
     */
    public function __construct(WorkProcess $model)
    {
        $this->model = $model;
    }

    public function getWorkProcessById(int $id = 0, $language_id = 1){
        return $this->model->select([
                'work_processes.id',
                'work_processes.publish',
                'work_processes.image',
                'work_processes.order',
                'tb2.name',
                'tb2.description',
                'tb2.content',
            ]
        )
        ->join('work_process_language as tb2', 'tb2.work_process_id', '=', 'work_processes.id')
        ->where('tb2.language_id', $language_id)
        ->find($id);
    }

    public function getWorkProcessByCondition(
        array $condition = [],
        bool $flag = false,
        array $relation = [],
        array $orderBy = ['id', 'desc'],
        array $param = [],
        array $withCount = []
    ) {
        $query = $this->model->newQuery();

        // Standard V2 JOIN approach for listing
        $query->select([
            'work_processes.id',
            'work_processes.publish',
            'work_processes.image',
            'work_processes.order',
            'tb2.name',
            'tb2.description',
        ]);
        $query->join('work_process_language as tb2', 'tb2.work_process_id', '=', 'work_processes.id');
        
        // Handle language filtering
        $languageId = $param['language_id'] ?? 1;
        $query->where('tb2.language_id', $languageId);

        // Add scope filters
        $query->keyword($param['keyword'] ?? null)
              ->publish($param['publish'] ?? null);

        // Ordering
        if (!empty($orderBy)) {
            $query->orderBy($orderBy[0], $orderBy[1]);
        }

        return $query->paginate($param['perpage'] ?? 20);
    }
}
