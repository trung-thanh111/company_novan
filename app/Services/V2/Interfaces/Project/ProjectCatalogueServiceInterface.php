<?php

namespace App\Services\V2\Interfaces\Project;

interface ProjectCatalogueServiceInterface
{
    public function pagination($request);
    public function create($request, $languageId);
    public function update($id, $request, $languageId);
    public function findById($id);
    public function destroy($id);
}
