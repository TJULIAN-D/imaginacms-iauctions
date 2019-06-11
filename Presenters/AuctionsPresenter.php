<?php

namespace Modules\Iauctions\Presenters;


use Laracasts\Presenter\Presenter;
use Modules\Iauctions\Entities\Status;


class AuctionsPresenter extends Presenter
{
    protected $status;
    protected $auctions;

    public function __construct($entity)
    {
        parent::__construct($entity);
        $this->auctions = app('Modules\Iauctions\Repositories\AuctionRepository');
        $this->status = app('Modules\Iauctions\Entities\StatusAuction');
    }

    /**
     * Get the post status
     * @return string
     */
    public function status()
    {
        return $this->status->get($this->entity->status);

    }

    /**
     * Getting the label class for the appropriate status
     * @return string
     */
    public function statusLabelClass()
    {
        switch ($this->entity->status) {
            case Status::DRAFT:
                return 'bg-yellow';
                break;

            case Status::PUBLISHED:
            case Status::PENDING:
                return 'bg-green';
                break;

            case Status::FINISHED:
                return 'bg-red';
                break;

            default:
                return 'bg-red';
                break;
        }
    }
}