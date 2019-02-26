<?php

namespace Modules\Iauctions\Presenters;


use Laracasts\Presenter\Presenter;
use Modules\Iauctions\Entities\Status;


class AuctionsProviderPresenter extends Presenter
{
    /**
     * @var \Modules\Iauctions\Entities\Status
     */
    protected $status;
    protected $autionsProvider;

    public function __construct($entity)
    {
        parent::__construct($entity);
        $this->autionsProvider = app('Modules\Iauctions\Repositories\AuctionProviderRepository');
        $this->status = app('Modules\Iauctions\Entities\Status');
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
            case Status::PENDING:
                return 'bg-yellow';
                break;

            case Status::APPROVED:
                return 'bg-green';
                break;

            case Status::REJECTED:
                return 'bg-red';
                break;

            default:
                return 'bg-red';
                break;
        }
    }

}