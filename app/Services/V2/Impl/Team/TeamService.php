<?php  
namespace App\Services\V2\Impl\Team;

use App\Services\V2\BaseService;
use App\Services\V2\Interfaces\Team\TeamServiceInterface;
use App\Repositories\Interfaces\TeamRepositoryInterface as TeamRepository;
use Illuminate\Support\Facades\Auth;

class TeamService extends BaseService implements TeamServiceInterface
{

    protected $repository;

    protected $fillable;

    protected $with = ['users'];

    public function __construct(
        TeamRepository $repository,
    )
    {
        $this->repository = $repository;
    }

    public function prepareModelData(): static {
        $request = $this->context['request'] ?? null;
        if(!is_null($request)){
            $this->fillable = $this->repository->getFillable();
            $this->modelData = $request->only($this->fillable);
            $this->modelData['user_id'] = Auth::id();
        }
        return $this;
    }


}
