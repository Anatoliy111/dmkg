<?php
/**
 * Created by PhpStorm.
 * User: HONE
 * Date: 22.01.2021
 * Time: 0:29
 */


require_once(__DIR__ . '/../vendor/autoload.php');
use Viber\Client;

$apiKey = '4d2db29edaa7d108-28c0c073fd1dca37-bc9a431e51433742'; // <- PLACE-YOU-API-KEY-HERE

$webhookUrl = 'https://dmkg.com.ua/viberbot/dmkgBot.php'; // <- PLACE-YOU-HTTPS-URL
try {
    $client = new Client([ 'token' => $apiKey ]);
    $result = $client->setWebhook($webhookUrl);
    echo "Success!\n";
} catch (Exception $e) {
    echo "Error: ". $e->getMessage() ."\n";
}