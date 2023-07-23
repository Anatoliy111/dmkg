<?php


namespace app\poslug\components;


use yii\base\Widget;
use yii\bootstrap\Modal;

class ModalMessWidget extends Widget
{


    public function init()
    {
        parent::init();

    }

    public function run()
    {

        <?php
        Modal::begin([

            'header' => '<h2>'.$modalformheader.'</h2>',
        //			'toggleButton' => ['label' => 'click me'],
        //			'footer' => 'Низ окна',
            'id' => 'modalmess1',
            'size' => 'modal-md',
            'headerOptions' => [
                'style' => 'text-align: center;'
            ],

        ]);
        ?>

        <div class="modal-email">

            <img itemprop="image" src="<?= $asset->baseUrl.'/'.$modalformimage ?>" alt="EMAIL">

            <?php
            echo '<h3 style="line-height: 1.5;">'.$modalformtext.'</h3>';
            ?>
        </div>


        <?php Modal::end(); ?>

    }
}


