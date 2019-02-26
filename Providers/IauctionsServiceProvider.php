<?php

namespace Modules\Iauctions\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Iauctions\Events\Handlers\RegisterIauctionsSidebar;

class IauctionsServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterIauctionsSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('products', array_dot(trans('iauctions::products')));
            $event->load('auctions', array_dot(trans('iauctions::auctions')));
            $event->load('bids', array_dot(trans('iauctions::bids')));
            $event->load('categories', array_dot(trans('iauctions::categories')));
            $event->load('ingredients', array_dot(trans('iauctions::ingredients')));
            $event->load('userproducts', array_dot(trans('iauctions::userproducts')));
            $event->load('auctionproviderproducts', array_dot(trans('iauctions::auctionproviderproducts')));
            $event->load('auctionproviders', array_dot(trans('iauctions::auctionproviders')));
            // append translations

        });
    }

    public function boot()
    {
        $this->publishConfig('iauctions', 'permissions');
        $this->publishConfig('iauctions', 'settings');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Iauctions\Repositories\ProductRepository',
            function () {
                $repository = new \Modules\Iauctions\Repositories\Eloquent\EloquentProductRepository(new \Modules\Iauctions\Entities\Product());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Iauctions\Repositories\Cache\CacheProductDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Iauctions\Repositories\AuctionRepository',
            function () {
                $repository = new \Modules\Iauctions\Repositories\Eloquent\EloquentAuctionRepository(new \Modules\Iauctions\Entities\Auction());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Iauctions\Repositories\Cache\CacheAuctionDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Iauctions\Repositories\BidRepository',
            function () {
                $repository = new \Modules\Iauctions\Repositories\Eloquent\EloquentBidRepository(new \Modules\Iauctions\Entities\Bid());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Iauctions\Repositories\Cache\CacheBidDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Iauctions\Repositories\IngredientRepository',
            function () {
                $repository = new \Modules\Iauctions\Repositories\Eloquent\EloquentIngredientRepository(new \Modules\Iauctions\Entities\Ingredient());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Iauctions\Repositories\Cache\CacheIngredientDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Iauctions\Repositories\UserProductRepository',
            function () {
                $repository = new \Modules\Iauctions\Repositories\Eloquent\EloquentUserProductRepository(new \Modules\Iauctions\Entities\UserProduct());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Iauctions\Repositories\Cache\CacheUserProductDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Iauctions\Repositories\AuctionProviderProductRepository',
            function () {
                $repository = new \Modules\Iauctions\Repositories\Eloquent\EloquentAuctionProviderProductRepository(new \Modules\Iauctions\Entities\AuctionProviderProduct());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Iauctions\Repositories\Cache\CacheAuctionProviderProductDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Iauctions\Repositories\AuctionProviderRepository',
            function () {
                $repository = new \Modules\Iauctions\Repositories\Eloquent\EloquentAuctionProviderRepository(new \Modules\Iauctions\Entities\AuctionProvider());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Iauctions\Repositories\Cache\CacheAuctionProviderDecorator($repository);
            }
        );
// add bindings










    }
}
