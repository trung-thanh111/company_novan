<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */

     public $bindings = [
        'App\Repositories\Interfaces\CustomerRepositoryInterface' => 'App\Repositories\Customer\CustomerRepository',
        'App\Repositories\Interfaces\CustomerCatalogueRepositoryInterface' => 'App\Repositories\Customer\CustomerCatalogueRepository',
        'App\Repositories\Interfaces\UserRepositoryInterface' => 'App\Repositories\User\UserRepository',
        'App\Repositories\Interfaces\UserCatalogueRepositoryInterface' => 'App\Repositories\User\UserCatalogueRepository',
        'App\Repositories\Interfaces\LanguageRepositoryInterface' => 'App\Repositories\Core\LanguageRepository',
        'App\Repositories\Interfaces\PostCatalogueRepositoryInterface' => 'App\Repositories\Post\PostCatalogueRepository',
        'App\Repositories\Interfaces\GenerateRepositoryInterface' => 'App\Repositories\GenerateRepository',
        'App\Repositories\Interfaces\PermissionRepositoryInterface' => 'App\Repositories\User\PermissionRepository',
        'App\Repositories\Interfaces\PostRepositoryInterface' => 'App\Repositories\Post\PostRepository',
        'App\Repositories\Interfaces\ProvinceRepositoryInterface' => 'App\Repositories\User\ProvinceRepository',
        'App\Repositories\Interfaces\DistrictRepositoryInterface' => 'App\Repositories\Core\DistrictRepository',
        'App\Repositories\Interfaces\RouterRepositoryInterface' => 'App\Repositories\Core\RouterRepository',
        'App\Repositories\Interfaces\ProductCatalogueRepositoryInterface' => 'App\Repositories\Product\ProductCatalogueRepository',
        'App\Repositories\Interfaces\ProductRepositoryInterface' => 'App\Repositories\Product\ProductRepository',
        'App\Repositories\Interfaces\ProductCatalogueRepositoryInterface' => 'App\Repositories\Product\ProductCatalogueRepository',
        'App\Repositories\Interfaces\ProductRepositoryInterface' => 'App\Repositories\Product\ProductRepository',
        'App\Repositories\Interfaces\AttributeCatalogueRepositoryInterface' => 'App\Repositories\Attribute\AttributeCatalogueRepository',
        'App\Repositories\Interfaces\AttributeRepositoryInterface' => 'App\Repositories\Attribute\AttributeRepository',
        'App\Repositories\Interfaces\ProductVariantLanguageRepositoryInterface' => 'App\Repositories\Product\ProductVariantLanguageRepository',
        'App\Repositories\Interfaces\ProductVariantAttributeRepositoryInterface' => 'App\Repositories\Product\ProductVariantAttributeRepository',
        'App\Repositories\Interfaces\SystemRepositoryInterface' => 'App\Repositories\Core\SystemRepository',
        'App\Repositories\Interfaces\IntroduceRepositoryInterface' => 'App\Repositories\Core\IntroduceRepository',
        'App\Repositories\Interfaces\MenuCatalogueRepositoryInterface' => 'App\Repositories\Menu\MenuCatalogueRepository',
        'App\Repositories\Interfaces\MenuRepositoryInterface' => 'App\Repositories\Menu\MenuRepository',
        'App\Repositories\Interfaces\SlideRepositoryInterface' => 'App\Repositories\Core\SlideRepository',
        'App\Repositories\Interfaces\WidgetRepositoryInterface' => 'App\Repositories\Core\WidgetRepository',
        'App\Repositories\Interfaces\PromotionRepositoryInterface' => 'App\Repositories\Product\PromotionRepository',
        'App\Repositories\Interfaces\SourceRepositoryInterface' => 'App\Repositories\SourceRepository',
        'App\Repositories\Interfaces\ProductVariantRepositoryInterface' => 'App\Repositories\Product\ProductVariantRepository',
        'App\Repositories\Interfaces\OrderRepositoryInterface' => 'App\Repositories\Core\OrderRepository',
        'App\Repositories\Interfaces\ReviewRepositoryInterface' => 'App\Repositories\Core\ReviewRepository',
        'App\Repositories\Interfaces\DistributionRepositoryInterface' => 'App\Repositories\DistributionRepository',
        'App\Repositories\Interfaces\AgencyRepositoryInterface' => 'App\Repositories\AgencyRepository',
        'App\Repositories\Interfaces\ConstructRepositoryInterface' => 'App\Repositories\ConstructRepository',
        'App\Repositories\Interfaces\VoucherRepositoryInterface' => 'App\Repositories\VoucherRepository',
        'App\Repositories\Interfaces\ContactRepositoryInterface' => 'App\Repositories\Core\ContactRepository',
        'App\Repositories\Interfaces\LecturerRepositoryInterface' => 'App\Repositories\Core\LecturerRepository',
        'App\Repositories\Interfaces\SchoolRepositoryInterface' => 'App\Repositories\SchoolRepository',
        'App\Repositories\Interfaces\SchoolCatalogueRepositoryInterface' => 'App\Repositories\SchoolCatalogueRepository',
        'App\Repositories\Interfaces\ScholarshipRepositoryInterface' => 'App\Repositories\ScholarshipRepository',
        'App\Repositories\Interfaces\ScholarshipCatalogueRepositoryInterface' => 'App\Repositories\ScholarshipCatalogueRepository',
        'App\Repositories\Interfaces\TrainRepositoryInterface' => 'App\Repositories\TrainRepository',
        'App\Repositories\Interfaces\PolicyRepositoryInterface' => 'App\Repositories\PolicyRepository',
        'App\Repositories\Interfaces\AreaRepositoryInterface' => 'App\Repositories\AreaRepository',
        'App\Repositories\Interfaces\CityRepositoryInterface' => 'App\Repositories\CityRepository',
        'App\Repositories\Interfaces\ProjectRepositoryInterface' => 'App\Repositories\ProjectRepository',
        'App\Repositories\Interfaces\ProjectCatalogueRepositoryInterface' => 'App\Repositories\ProjectCatalogueRepository',
        'App\Repositories\Interfaces\ServiceCatalogueRepositoryInterface' => 'App\Repositories\Company\ServiceCatalogueRepository',
        'App\Repositories\Interfaces\ServiceRepositoryInterface' => 'App\Repositories\Company\ServiceRepository',
        'App\Repositories\Interfaces\TeamRepositoryInterface' => 'App\Repositories\Team\TeamRepository',
        'App\Repositories\Interfaces\FaqRepositoryInterface' => 'App\Repositories\Faq\FaqRepository',
        'App\Repositories\Interfaces\FaqCatalogueRepositoryInterface' => 'App\Repositories\Faq\FaqCatalogueRepository',
        'App\Repositories\Interfaces\PartnerRepositoryInterface' => 'App\Repositories\Partner\PartnerRepository',
        'App\Repositories\Interfaces\AchievementRepositoryInterface' => 'App\Repositories\Achievement\AchievementRepository',
        'App\Repositories\CoreValue\CoreValueRepositoryInterface' => 'App\Repositories\CoreValue\CoreValueRepository',
        'App\Repositories\Interfaces\WorkProcess\WorkProcessRepositoryInterface' => 'App\Repositories\WorkProcess\WorkProcessRepository',
    ];

    public function register(): void
    {
        foreach($this->bindings as $key => $val)
        {
            $this->app->bind($key, $val);
        }
    }

    
    public function boot(): void
    {
        
    }
}
