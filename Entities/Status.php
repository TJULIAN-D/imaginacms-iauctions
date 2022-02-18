<?php

namespace Modules\Iauctions\Entities;


class Status
{
    const PENDING = 0;
    const ACTIVE = 1;
    const FINISHED = 2;
    
    private $statuses = [];

    public function __construct()
    {
        $this->statuses = [
            self::PENDING => trans('iauctions::auctions.status.pending'),
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

        return $this->statuses[self::PENDING];
    }
    
}
