<?php

namespace Modules\Iauctions\Events;

use Illuminate\Queue\SerializesModels;

class BidWasCreated
{
    /**
     * @var array
     */
    public $data;
    /**
     * @var Post
     */
    public $bit;

    public function __construct($bit, array $data)
    {
        $this->data = $data;
        $this->bit = $bit;
    }

    /**
     * Return the entity
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getEntity()
    {
        return $this->bit;
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
