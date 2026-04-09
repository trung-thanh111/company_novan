<?php

namespace App\Services\V1\Interfaces\WorkProcess;

use App\Services\V2\Interfaces\BaseServiceInterface;

/**
 * Interface WorkProcessServiceInterface
 * @package App\Services\V1\Interfaces\WorkProcess
 */
interface WorkProcessServiceInterface extends BaseServiceInterface
{
    public function paginate($request, $languageId);
    public function create($request, $languageId);
    public function update($id, $request, $languageId);
}
