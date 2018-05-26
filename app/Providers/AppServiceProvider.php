<?php namespace App\Providers;

use App\Domain\Link;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Services\HomeService;
use Services\LinkService;

/**
 * Class AppServiceProvider
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $linkService = new LinkService(new Link);
        $homeService = new HomeService();

        View::share('links', $linkService->model()->newQuery()->main()->get());
        View::share('color', $homeService->viewData('color'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
