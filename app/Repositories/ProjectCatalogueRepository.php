<?php

namespace App\Repositories;

use App\Models\ProjectCatalogue;
use App\Repositories\Interfaces\ProjectCatalogueRepositoryInterface;

/**
 * Class ProjectCatalogueRepository
 * @package App\Repositories
 */
class ProjectCatalogueRepository extends BaseRepository implements ProjectCatalogueRepositoryInterface
{
    protected $model;

    public function __construct(
        ProjectCatalogue $model
    ){
        $this->model = $model;
        parent::__construct($model);
    }
}
