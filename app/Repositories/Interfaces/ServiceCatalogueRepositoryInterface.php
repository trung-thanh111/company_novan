<?php

namespace App\Repositories\Interfaces;

/**
 * Interface ServiceCatalogueRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface ServiceCatalogueRepositoryInterface extends BaseRepositoryInterface
{
    public function getServiceCatalogueById(int $id = 0, int $language_id = 0);
}
