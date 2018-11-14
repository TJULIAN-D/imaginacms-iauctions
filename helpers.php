<?php

use Modules\Iauctions\Entities\Status;
use Modules\Iauctions\Entities\StatusAuction;
use Modules\Iauctions\Entities\Unity;

if(! function_exists('iauctions_format_date')){
   
    function iauctions_format_date($date, $format='d/m/Y h:i A'){
        return date($format, strtotime($date));
    }

}

/**
 * Get Status
 *
 * @param  none
 * @return Array $status
 */
if (!function_exists('iauctions_get_status')) {

    function iauctions_get_status()
    {
        $status = new Status();
        return $status;
    }
}

/**
 * Get StatusAction
 *
 * @param  none
 * @return Array $statusaction
 */
if (!function_exists('iauctions_get_statusAuction')) {

    function iauctions_get_statusAuction()
    {
        $status = new StatusAuction();
        return $status;
    }
}

/**
 * Get Unity
 *
 * @param  none
 * @return Array $unity
 */
if (!function_exists('iauctions_get_unity')) {

    function iauctions_get_unity()
    {
        $unity = new Unity();
        return $unity;
    }
}