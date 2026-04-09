<?php

namespace App\Repositories\CoreValue;

use App\Repositories\Interfaces\BaseRepositoryInterface;

/**
 * Interface CoreValueRepositoryInterface
 * @package App\Repositories\CoreValue
 */
interface CoreValueRepositoryInterface extends BaseRepositoryInterface
{
    public function getCoreValueByCondition(
        array $condition = [], 
        bool $flag = false, 
        array $relation = [], 
        array $orderBy = ['id', 'desc'], 
        array $param = [], 
        array $withCount = []
    );
}
