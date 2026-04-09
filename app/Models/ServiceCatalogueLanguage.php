<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCatalogueLanguage extends Model
{
    use HasFactory;

    protected $table = 'service_catalogue_language';

    public function service_catalogues(){
        return $this->belongsTo(ServiceCatalogue::class, 'service_catalogue_id', 'id');
    }
}
