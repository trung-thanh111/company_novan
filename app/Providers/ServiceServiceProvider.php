<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public $bindings = [
        'App\Services\V2\Interfaces\Company\ServiceServiceInterface' => 'App\Services\V2\Impl\Company\ServiceService',
        'App\Services\V2\Interfaces\Company\ServiceCatalogueServiceInterface' => 'App\Services\V2\Impl\Company\ServiceCatalogueService',
        'App\Services\V2\Interfaces\Team\TeamServiceInterface' => 'App\Services\V2\Impl\Team\TeamService',
        'App\Services\V2\Interfaces\Faq\FaqServiceInterface' => 'App\Services\V2\Impl\Faq\FaqService',
        'App\Services\V2\Interfaces\Faq\FaqCatalogueServiceInterface' => 'App\Services\V2\Impl\Faq\FaqCatalogueService',
        'App\Services\V2\Interfaces\Partner\PartnerServiceInterface' => 'App\Services\V2\Impl\Partner\PartnerService',
        'App\Services\V2\Interfaces\Achievement\AchievementServiceInterface' => 'App\Services\V2\Impl\Achievement\AchievementService',
        'App\Services\V1\Interfaces\CoreValue\CoreValueServiceInterface' => 'App\Services\V1\Impl\CoreValue\CoreValueService',
        'App\Services\V1\Interfaces\WorkProcess\WorkProcessServiceInterface' => 'App\Services\V1\Impl\WorkProcess\WorkProcessService',
        'App\Services\V2\Interfaces\Project\ProjectServiceInterface' => 'App\Services\V2\Impl\Project\ProjectService',
        'App\Services\V2\Interfaces\Project\ProjectCatalogueServiceInterface' => 'App\Services\V2\Impl\Project\ProjectCatalogueService',
    ];

    public function register(): void
    {
        foreach($this->bindings as $key => $val)
        {
            $this->app->bind($key, $val);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
