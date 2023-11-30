<?php
namespace yii\easyii\modules\informing;

class InformingModule extends \yii\easyii\components\Module
{
    public $settings = [
        'enableThumb' => true,
        'enablePhotos' => true,
        'enableShort' => true,
        'shortMaxLength' => 256,
        'enableTags' => true
    ];

    public static $installConfig = [
        'title' => [
            'en' => 'Informing',
            'ru' => 'Оголошення',
        ],
        'icon' => 'flag',
        'order_num' => 70,
    ];
}