<?php

namespace Modules\Ientitys\Events;

use Illuminate\Queue\SerializesModels;

class AuctionWasCreated
{
    use SerializesModels;

    public $entity;

    public $data;

    /**
     * Create a new event instance.
     *
     * @param aution
     * @param array $data
     */
    public function __construct($entity, array $data)
    {
        $this->data = $data;
        $this->entity = $entity;
    }

    /**
     * @return mixed
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * Return the ALL data sent
     * @return array
     */

    public function getSubmissionData()
    {
        return $this->data;
    }
}
