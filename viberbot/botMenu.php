<?php
/**
 * Created by PhpStorm.
 * User: Пользователь
 * Date: 23.03.2021
 * Time: 16:43
 */

require_once(__DIR__ . '/../vendor/autoload.php');

use Viber\Bot;
use Viber\Api\Sender;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


function getKpMenu(){

    return (new \Viber\Api\Keyboard())
        ->setButtons([
            (new \Viber\Api\Keyboard\Button())
                ->setColumns(2)
                //->setBgColor('#8074d6')
                // ->setTextSize('small')
                ->setTextSize('small')
                ->setTextHAlign('center')
                ->setTextVAlign('center')
                ->setActionType('reply')
                ->setActionBody('Infomenu-button')
                ->setBgColor("#75C5F3")
                ->setText('📈  Інформація по ос.рахунках'),

            (new \Viber\Api\Keyboard\Button())
                ->setColumns(2)
                //  ->setBgColor('#2fa4e7')
                ->setTextHAlign('center')
                ->setTextSize('small')
                ->setActionType('reply')
                ->setActionBody('Pokazmenu-button')
                ->setBgColor("#75C5F3")
                // ->setImage("https://dmkg.com.ua/uploads/copy.png")
                ->setText('📟  Подати показники'),

            (new \Viber\Api\Keyboard\Button())
                ->setColumns(2)
                //  ->setBgColor('#2fa4e7')
                ->setTextHAlign('center')
                ->setTextSize('small')
                ->setActionType('reply')
                ->setActionBody('Rahmenu-button')
                ->setBgColor("#75C5F3")
                // ->setImage("https://dmkg.com.ua/uploads/copy.png")
                ->setText('♻  Операції з ос.рахунками'),


            (new \Viber\Api\Keyboard\Button())
                ->setColumns(3)
                //  ->setBgColor('#2fa4e7')
                ->setTextHAlign('center')
                ->setTextSize('large')
                ->setActionType('reply')
                ->setActionBody('Kontakt-button')
                // ->setBgColor("#F3DD27")
                // ->setImage("https://dmkg.com.ua/uploads/copy.png")
                ->setText('📞 Контактна інформація'),

            (new \Viber\Api\Keyboard\Button())
                ->setColumns(3)
                ->setActionType('open-url')
                ->setActionBody('https://next.privat24.ua/payments/form/%7B%22companyID%22:%222381919%22,%22form%22:%7B%22query%22:%2233006271%22%7D%7D')
                ->setImage("https://dmkg.com.ua/uploads/privat800x200.png"),
        ]);

}

function getDmkgMenu(){

    return (new \Viber\Api\Keyboard())
        ->setButtons([
            (new \Viber\Api\Keyboard\Button())
                ->setColumns(2)
                //->setBgColor('#8074d6')
                // ->setTextSize('small')
                ->setTextSize('small')
                ->setTextHAlign('center')
                ->setTextVAlign('center')
                ->setActionType('reply')
                ->setActionBody('Infomenu-button')
                ->setBgColor("#75C5F3")
                ->setText('📈  Інформація по ос.рахунках'),

//            (new \Viber\Api\Keyboard\Button())
//                ->setColumns(2)
//                //  ->setBgColor('#2fa4e7')
//                ->setTextHAlign('center')
//                ->setTextSize('small')
//                ->setActionType('reply')
//                ->setActionBody('Pokazmenu-button')
//                ->setBgColor("#75C5F3")
//                // ->setImage("https://dmkg.com.ua/uploads/copy.png")
//                ->setText('📟  Подати показники'),

            (new \Viber\Api\Keyboard\Button())
                ->setColumns(2)
                //  ->setBgColor('#2fa4e7')
                ->setTextHAlign('center')
                ->setTextSize('small')
                ->setActionType('reply')
                ->setActionBody('Rahmenu-button')
                ->setBgColor("#75C5F3")
                // ->setImage("https://dmkg.com.ua/uploads/copy.png")
                ->setText('♻  Операції з ос.рахунками'),


            (new \Viber\Api\Keyboard\Button())
                ->setColumns(3)
                //  ->setBgColor('#2fa4e7')
                ->setTextHAlign('center')
                ->setTextSize('large')
                ->setActionType('reply')
                ->setActionBody('Kontakt-button')
                // ->setBgColor("#F3DD27")
                // ->setImage("https://dmkg.com.ua/uploads/copy.png")
                ->setText('📞 Контактна інформація'),

            (new \Viber\Api\Keyboard\Button())
                ->setColumns(3)
                ->setActionType('open-url')
                ->setActionBody('https://next.privat24.ua/payments/form/%7B%22companyID%22:%222381919%22,%22form%22:%7B%22query%22:%2233006271%22%7D%7D')
                ->setImage("https://dmkg.com.ua/uploads/privat800x200.png"),
        ]);

}