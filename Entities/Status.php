<?php

namespace Modules\Iauctions\Entities;


class Status
{
    const INACTIVE = 0;
    const ACTIVE = 1;
    const FINISHED = 2;
    
    private $statuses = [];

    public function __construct()
    {
        $this->statuses = [
            self::INACTIVE => trans('iauctions::auctions.status.inactive'),
            self::ACTIVE => trans('iauctions::auctions.status.active'),
            self::FINISHED => trans('iauctions::auctions.status.finished'),
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

        return $this->statuses[self::INACTIVE];
    }
    
}
