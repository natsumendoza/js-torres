<?php
/**
 * Created by PhpStorm.
 * User: jhomar
 * Date: 10/30/17
 * Time: 1:26 AM
 */

namespace App\Http;
use Illuminate\Support\Facades\Mail;


class Helpers
{
    public static function sendEmail($data)
    {
        Mail::send('emails.email', $data, function($message) use ($data){
            $message->to($data['email'], $data['name'])
                ->subject('Transaction code: ' . $data['transactionCode'] . ' Order ID: ' . $data['orderId'] . ' ' . $data['status']);

        });
    }
}