<?php

namespace Modules\Iauctions\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterIauctionsSidebar implements \Maatwebsite\Sidebar\SidebarExtender
{
    /**
     * @var Authentication
     */
    protected $auth;

    /**
     * @param Authentication $auth
     *
     * @internal param Guard $guard
     */
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    public function handle(BuildingSidebar $sidebar)
    {
        $sidebar->add($this->extendWith($sidebar->getMenu()));
    }

    /**
     * @param Menu $menu
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('iauctions::auctions.plural'), function (Item $item) {
                $item->icon('fa fa-gavel');
                $item->weight(10);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('iauctions::products.plural'), function (Item $item) {
                    $item->icon('fa fa-arrow-circle-up');
                    $item->weight(3);
                    $item->append('admin.iauctions.product.create');
                    $item->route('admin.iauctions.product.index');
                    $item->authorize(
                        $this->auth->hasAccess('iauctions.products.index')
                    );
                });
                $item->item(trans('iauctions::auctions.plural'), function (Item $item) {
                    $item->icon('fa fa-gavel');
                    $item->weight(10);
                    $item->append('admin.iauctions.auction.create');
                    $item->route('admin.iauctions.auction.index');
                    $item->authorize(
                        $this->auth->hasAccess('iauctions.auctions.index')
                    );
                });
                /*
                $item->item(trans('iauctions::bids.title.bids'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.iauctions.bid.create');
                    $item->route('admin.iauctions.bid.index');
                    $item->authorize(
                        $this->auth->hasAccess('iauctions.bids.index')
                    );
                });
                */
                $item->item(trans('iauctions::categories.plural'), function (Item $item) {
                    $item->icon('fa fa-list');
                    $item->weight(0);
                    $item->append('admin.iauctions.category.create');
                    $item->route('admin.iauctions.category.index');
                    $item->authorize(
                        $this->auth->hasAccess('iauctions.categories.index')
                    );
                });
                $item->item(trans('iauctions::ingredients.plural'), function (Item $item) {
                    $item->icon('fa fa-eyedropper');
                    $item->weight(1);
                    $item->append('admin.iauctions.ingredient.create');
                    $item->route('admin.iauctions.ingredient.index');
                    $item->authorize(
                        $this->auth->hasAccess('iauctions.ingredients.index')
                    );
                });
                /*
                $item->item(trans('iauctions::userproducts.title.userproducts'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.iauctions.userproduct.create');
                    $item->route('admin.iauctions.userproduct.index');
                    $item->authorize(
                        $this->auth->hasAccess('iauctions.userproducts.index')
                    );
                });
                */
                /*
                $item->item(trans('iauctions::auctionproviders.title.auctionproviders'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.iauctions.auctionprovider.create');
                    $item->route('admin.iauctions.auctionprovider.index');
                    $item->authorize(
                        $this->auth->hasAccess('iauctions.auctionproviders.index')
                    );
                });
                */
                /*
                $item->item(trans('iauctions::auctionproviderproducts.title.auctionproviderproducts'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.iauctions.auctionproviderproduct.create');
                    $item->route('admin.iauctions.auctionproviderproduct.index');
                    $item->authorize(
                        $this->auth->hasAccess('iauctions.auctionproviderproducts.index')
                    );
                });
                */
               
// append










            });
        });

        return $menu;
    }
}
