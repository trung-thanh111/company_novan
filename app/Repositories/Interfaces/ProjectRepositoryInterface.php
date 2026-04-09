<?php

namespace App\Repositories\Interfaces;

/**
 * Interface ProjectRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface ProjectRepositoryInterface extends BaseRepositoryInterface
{
    public function getProjectById(int $id = 0, int $language_id = 0);
}
