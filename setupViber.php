<?php
/**
 * Created by PhpStorm.
 * User: HONE
 * Date: 22.01.2021
 * Time: 0:29
 */

require_once("/var/www/dmkg.com.ua/vendor/autoload.php");
use Viber\Client;

$apiKey = '4cc2a5b34ba7d2bf-ad220322f4f8ca5b-dd7d0419116d069a'; // <- PLACE-YOU-API-KEY-HERE
$webhookUrl = 'https://dmkg.com.ua/viber/bot.php'; // <- PLACE-YOU-HTTPS-URL
try {
    $client = new Client([ 'token' => $apiKey ]);
    $result = $client->setWebhook($webhookUrl);
    echo "Success!\n";
} catch (Exception $e) {
    echo "Error: ". $e->getMessage() ."\n";
}