<?php

namespace Modules\Iauctions\Entities;

class Unity
{

    const ml = 0;
    const g = 1;
   
    private $unities = [];

    public function __construct()
    {

        $this->unities = [
            self::ml => 'ml',
            self::g => 'g',
        ];

    }

    /**
     * Get the available statuses
     * @return array
     */
    public function lists()
    {
        return $this->unities;
    }

    /**
     * Get the auction status
     * @param int $statusId
     * @return string
     */
    public function get($unityId)
    {
        
        if (isset($this->unities[$unityId])) {
            return $this->unities[$unityId];
        }

        return $this->unities[self::g];
    }

}

