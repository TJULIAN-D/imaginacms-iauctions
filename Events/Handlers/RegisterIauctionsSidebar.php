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

                $item->item(trans('iauctions::ingredients.plural'), function (Item $item) {
                    $item->icon('fa fa-eyedropper');
                    $item->weight(1);
                    $item->append('admin.iauctions.ingredient.create');
                    $item->route('admin.iauctions.ingredient.index');
                    $item->authorize(
                        $this->auth->hasAccess('iauctions.ingredients.index')
                    );
                });
            });
        });

        return $menu;
    }
}
