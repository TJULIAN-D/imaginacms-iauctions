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

/**
 * Send Email
 *
 * @param options array
 * @return response Email
 */
if (!function_exists('iauctions_emailSend')) {

    function iauctions_emailSend($options = array())
    {
        $default_options = array(
            'email_from' => array(),
            'theme' => null,
            'email_to' => array(),
            'subject' => null,
            'sender' => null,
            'data' => array(
                'title' => null,
                'intro' => null,
                'content' => array(),
            ),
        );

        $options = array_merge($default_options, $options);
        $response = array();
        try {
            $data = $options['data'];

            /**
             * Send email
             */

            $email_to = $options['email_to'];
            $email_from = $options['email_from'];

            $sender = $options['sender'];
            $subject = $options['subject'];

            Mail::send($options['theme'],
                [
                    'data' => $data,
                ], function ($message) use ($email_to, $sender, $subject, $email_from) {
                    $message->to($email_to, $sender)
                        ->from($email_from, $sender)
                        ->subject($subject);
                });
            $response['status'] = 'success';
            $response['msg'] = '';

        } catch (\Throwable $t) {

            $response['status'] = 'error';
            $response['msg'] = $t->getMessage();
        }

        return $response;


    }
}



