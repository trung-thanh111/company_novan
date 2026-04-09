<?php

namespace App\Repositories\Interfaces;

/**
 * Interface ServiceRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface ServiceRepositoryInterface extends BaseRepositoryInterface
{
    public function getServiceById(int $id = 0, int $language_id = 0);
}
