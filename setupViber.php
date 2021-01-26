<?php
/**
 * Created by PhpStorm.
 * User: HONE
 * Date: 22.01.2021
 * Time: 0:29
 */


require_once(__DIR__ . '/vendor/autoload.php');
use Viber\Client;


$apiKey = '4cca41c0f8a7df2d-744b96600fc80160-bd5e7b2d32cfdc9b'; // <- PLACE-YOU-API-KEY-HERE
$webhookUrl = 'https://dmkg.com.ua/viber/bot'; // <- PLACE-YOU-HTTPS-URL
try {
    $client = new Client([ 'token' => $apiKey ]);
    $result = $client->setWebhook($webhookUrl);
    echo "Success!\n";
} catch (Exception $e) {
    echo "Error: ". $e->getMessage() ."\n";
}