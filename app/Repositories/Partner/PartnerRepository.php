<?php

namespace App\Repositories\Partner;

use App\Models\Partner;
use App\Repositories\Interfaces\PartnerRepositoryInterface;
use App\Repositories\BaseRepository;

/**
 * Class PartnerRepository
 * @package App\Repositories
 */
class PartnerRepository extends BaseRepository implements PartnerRepositoryInterface
{
    protected $model;

    public function __construct(
        Partner $model
    ){
        $this->model = $model;
    }

    public function getPartnerById(int $id = 0, $language_id = 1){
        return $this->model->select([
                'partners.id',
                'partners.publish',
                'partners.image',
                'partners.link',
                'partners.order',
                'tb2.name',
                'tb2.description',
            ]
        )
        ->join('partner_language as tb2', 'tb2.partner_id', '=', 'partners.id')
        ->where('tb2.language_id', $language_id)
        ->find($id);
    }

}
