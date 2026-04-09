<?php  
namespace App\Repositories\Team;

use App\Models\Team;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\TeamRepositoryInterface;

class TeamRepository extends BaseRepository implements TeamRepositoryInterface
{
    protected $model;

    public function __construct(
        Team $model
    )
    {
        $this->model = $model;
        parent::__construct($model);
    }
}
