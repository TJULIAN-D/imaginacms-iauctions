<?php

namespace Modules\Iauctions\Entities;

class Status
{
    const PENDING = 0;
    const APPROVED = 1;
    const REJECTED = 2;
   

    private $statuses = [];

    public function __construct()
    {

        $this->statuses = [
            self::PENDING => trans('iauctions::common.status.pending'),
            self::APPROVED => trans('iauctions::common.status.approved'),
            self::REJECTED => trans('iauctions::common.status.rejected'),
        ];

    }

    /**
     * Get the available statuses
     * @return array
     */
    public function lists()
    {
        return $this->statuses;
    }

    /**
     * Get the auction status
     * @param int $statusId
     * @return string
     */
    public function get($statusId)
    {
        
        if (isset($this->statuses[$statusId])) {
            return $this->statuses[$statusId];
        }

        return $this->statuses[self::PENDING];
    }

}

