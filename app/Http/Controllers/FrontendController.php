<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Language;
use App\Models\System;

class FrontendController extends Controller
{
    protected $language;
    protected $systemRepository;
    protected $system;

    public function __construct()
    {
        $this->setLanguage();
        $this->setSystem();
    }

    public function setLanguage()
    {
        $locale = app()->getLocale() ?? 'vn';
        
        // Cache language record in app config to avoid duplicate queries in Services
        $language = Language::where('canonical', $locale)->first();
        $this->language = $language->id ?? 1;
        
        config(['app.language_id' => $this->language]);
    }

    public function setSystem()
    {
        // Use the initialized language directly
        $this->system = convert_array(
            System::where('language_id', $this->language)->get(), 
            'keyword', 
            'content'
        );
    }
   

}
