<?php

namespace App\Services;
use GuzzleHttp\Client;
use GuzzleHttp\Message\Request;
use GuzzleHttp\Message\Response;

class PhoneService
{
public static function createAndSendCode($phone){
    $code = rand(0,9).rand(0,9).rand(0,9).rand(0,9);
    $message = "COFFEETIME. Ваш код верификации:".$code;
    $client = new Client();
    $client->get("https://semysms.net/api/3/sms.php?token=".env('SEMISMS_TOKEN')."&device=308878&phone=+".$phone."&msg=".$message);
    return $code;
}
}