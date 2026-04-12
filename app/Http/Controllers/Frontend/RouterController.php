<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\FrontendController;
use Illuminate\Http\Request;
use App\Repositories\Core\RouterRepository;
use App\Models\Post;
use App\Http\Controllers\Frontend\PostCatalogueController;

class RouterController extends FrontendController
{
    protected $language;
    protected $routerRepository;
    protected $router;

    public function __construct(
        RouterRepository $routerRepository,
    ) {
        $this->routerRepository = $routerRepository;
        parent::__construct();
    }


    public function index(string $canonical = '', Request $request)
    {
        $this->getRouter($canonical);
        if (!is_null($this->router) && !empty($this->router)) {
            $method = 'index';
            $controller = app($this->router->controllers);

            // Build argument list for the controller method by inspecting its parameters
            $args = [];
            try {
                $ref = new \ReflectionMethod($controller, $method);
                foreach ($ref->getParameters() as $param) {
                    $pname = $param->getName();
                    $ptype = $param->getType();

                    // Match common parameter names/types
                    if ($ptype && $ptype->getName() === \Illuminate\Http\Request::class) {
                        $args[] = $request;
                    } elseif (stripos($pname, 'page') !== false) {
                        // default page 1
                        $args[] = 1;
                    } else {
                        // fallback to module_id for other scalar params
                        $args[] = $this->router->module_id;
                    }
                }
            } catch (\ReflectionException $e) {
                // on error, fall back to original ordering
                $args = [$this->router->module_id, $request];
            }

            echo $controller->{$method}(...$args);
        } else {
            // fallback: try to resolve as a Post canonical
            // Accept canonicals both with and without trailing .html and
            // fully qualify the pivot column to avoid ambiguous column error.
            $slug = $canonical;
            $slugNoHtml = (str_ends_with($slug, '.html')) ? substr($slug, 0, -5) : $slug;

            $post = Post::whereHas('languages', function ($q) use ($slug, $slugNoHtml) {
                $q->where(function ($q2) use ($slug, $slugNoHtml) {
                    $q2->where('post_language.canonical', $slug)
                        ->orWhere('post_language.canonical', $slugNoHtml);
                });
            })->whereHas('languages', function ($q) {
                $q->where('post_language.language_id', $this->language);
            })->first();

            if ($post) {
                // call the PostCatalogueController detail method
                $controller = app(PostCatalogueController::class);
                echo $controller->detail($post->id, $request);
                return;
            }

            // Fallback for ServiceCatalogue
            $serviceCatalogue = \App\Models\ServiceCatalogue::whereHas('languages', function ($q) use ($slug, $slugNoHtml) {
                $q->where(function ($q2) use ($slug, $slugNoHtml) {
                    $q2->where('service_catalogue_language.canonical', $slug)
                        ->orWhere('service_catalogue_language.canonical', $slugNoHtml);
                });
            })->whereHas('languages', function ($q) {
                $q->where('service_catalogue_language.language_id', $this->language);
            })->first();

            if ($serviceCatalogue) {
                $controller = app(\App\Http\Controllers\Frontend\ServiceCatalogueController::class);
                echo $controller->index($serviceCatalogue->id, $request);
                return;
            }

            // Fallback for Service (Detail)
            $service = \App\Models\Service::whereHas('languages', function ($q) use ($slug, $slugNoHtml) {
                $q->where(function ($q2) use ($slug, $slugNoHtml) {
                    $q2->where('service_language.canonical', $slug)
                        ->orWhere('service_language.canonical', $slugNoHtml);
                });
            })->whereHas('languages', function ($q) {
                $q->where('service_language.language_id', $this->language);
            })->first();

            if ($service) {
                $controller = app(\App\Http\Controllers\Frontend\ServiceController::class);
                echo $controller->index($service->id, $request);
                return;
            }

            abort(404);
        }
    }

    public function page(string $canonical = '', $page = 1, Request $request)
    {
        $this->getRouter($canonical);
        $request->merge(['page' => $page]);
        $page = (!isset($page)) ? 1 : $page;
        if (!is_null($this->router) && !empty($this->router)) {
            $method = 'index';
            $controller = app($this->router->controllers);
            $args = [];
            try {
                $ref = new \ReflectionMethod($controller, $method);
                foreach ($ref->getParameters() as $param) {
                    $pname = $param->getName();
                    $ptype = $param->getType();

                    if ($ptype && $ptype->getName() === \Illuminate\Http\Request::class) {
                        $args[] = $request;
                    } elseif (stripos($pname, 'page') !== false) {
                        $args[] = $page;
                    } else {
                        $args[] = $this->router->module_id;
                    }
                }
            } catch (\ReflectionException $e) {
                $args = [$this->router->module_id, $request, $page];
            }

            echo $controller->{$method}(...$args);
        } else {
            abort(404);
        }
    }

    public function getRouter($canonical)
    {
        $suffix = config('apps.general.suffix');
        $canonicalNoSuffix = str_ends_with($canonical, $suffix) ? substr($canonical, 0, -strlen($suffix)) : $canonical;
        
        $this->router = $this->routerRepository->findByCondition(
            [
                ['canonical', '=', $canonicalNoSuffix],
                ['language_id', '=', $this->language]
            ]
        );

        if (!$this->router) {
            $this->router = $this->routerRepository->findByCondition(
                [
                    ['canonical', '=', $canonical],
                    ['language_id', '=', $this->language]
                ]
            );
        }
    }
}
