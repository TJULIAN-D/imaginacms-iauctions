<?php

namespace Modules\Iauctions\Entities;


class StatusBid
{
    const DECLINED = 0;
    const RECEIVED = 1;
   
    private $statuses = [];

    public function __construct()
    {
        $this->statuses = [
            self::DECLINED => trans('iauctions::bids.status.declined'),
            self::RECEIVED => trans('iauctions::bids.status.received'),
        ];
    }

    public function lists()
    {
        return $this->statuses;
    }

   
    public function get($statusId)
    {
        if (isset($this->statuses[$statusId])) {
            return $this->statuses[$statusId];
        }

        return $this->statuses[self::RECEIVED];
    }
    
}
