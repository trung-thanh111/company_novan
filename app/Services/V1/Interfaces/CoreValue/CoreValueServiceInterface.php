<?php

namespace App\Services\V1\Interfaces\CoreValue;

interface CoreValueServiceInterface
{
    public function paginate($request, $languageId);
    public function create($request, $languageId);
    public function update($id, $request, $languageId);
    public function destroy($id);
    public function updateStatus($post = []);
    public function updateStatusAll($post = []);
    public function findByCondition($condition = [], $flag = false, $relation = [], $orderBy = ['id', 'desc'], $param = []);
}
