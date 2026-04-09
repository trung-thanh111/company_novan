<?php

namespace App\Repositories\Interfaces\WorkProcess;

use App\Repositories\Interfaces\BaseRepositoryInterface;

/**
 * Interface WorkProcessRepositoryInterface
 * @package App\Repositories\Interfaces\WorkProcess
 */
interface WorkProcessRepositoryInterface extends BaseRepositoryInterface
{
    public function getWorkProcessByCondition(
        array $condition = [],
        bool $flag = false,
        array $relation = [],
        array $orderBy = ['id', 'desc'],
        array $param = [],
        array $withCount = []
    );
}
