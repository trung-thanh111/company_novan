<?php

namespace App\Services\V2\Interfaces;

use Illuminate\Http\Request;

interface BaseServiceInterface
{
    public function pagination(Request $request);
    public function save(Request $request, string $action = 'store', ?int $id = null);
    public function destroy($id);
    public function findById($id);
    public function all(array $relation = [], string $selectRaw = '');
    public function findByCondition(
        $condition = [],
        $flag = false,
        $relation = [],
        array $orderBy = ['id', 'desc'],
        array $param = [],
        array $withCount = []
    );
    public function getCatalogueChildren($catalogue = null, $request);
}