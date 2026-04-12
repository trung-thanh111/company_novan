<?php

namespace App\Repositories\Interfaces;

/**
 * Interface ProjectCatalogueRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface ProjectCatalogueRepositoryInterface extends BaseRepositoryInterface
{
    public function getProjectCatalogueById(int $id = 0, int $language_id = 0);
}
