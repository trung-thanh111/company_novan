<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceLanguage extends Model
{
    use HasFactory;

    protected $table = 'service_language';

    public function services(){
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }
}
