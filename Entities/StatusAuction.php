<?php

namespace Modules\Iauctions\Entities;

class StatusAuction
{

    const DRAFT = 0;
    const PENDING = 1;
    const PUBLISHED = 2;
    const FINISHED = 3;

    private $statuses = [];

    public function __construct()
    {

        $this->statuses = [
            self::DRAFT => trans('iauctions::common.statusAuction.draft'),
            self::PENDING => trans('iauctions::common.statusAuction.pending'),
            self::PUBLISHED => trans('iauctions::common.statusAuction.published'),
            self::FINISHED => trans('iauctions::common.statusAuction.finished'),
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

        return $this->statuses[self::DRAFT];
    }

}

