<?php

namespace App\Repositories\Achievement;

use App\Models\Achievement;
use App\Repositories\Interfaces\AchievementRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class AchievementRepository
 * @package App\Repositories
 */
class AchievementRepository extends BaseRepository implements AchievementRepositoryInterface
{
    protected $model;

    public function __construct(
        Achievement $model
    ){
        $this->model = $model;
    }

    public function getAchievementById(int $id = 0, $language_id = 1){
        return $this->model->select([
                'achievements.id',
                'achievements.publish',
                'achievements.image',
                'achievements.order',
                'tb2.name',
                'tb2.description',
            ]
        )
        ->join('achievement_language as tb2', 'tb2.achievement_id', '=', 'achievements.id')
        ->where('tb2.language_id', $language_id)
        ->find($id);
    }

}
