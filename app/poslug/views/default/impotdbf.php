<?php
	/**
	 * Created by PhpStorm.
	 * User: USER
	 * Date: 17.03.2017
	 * Time: 17:50
	 */

use yii\bootstrap\Modal;

			Modal::begin([
				'header' => '<h2>Вот это модальное окно!</h2>',
				'toggleButton' => [
					'tag' => 'button',
					'class' => 'btn btn-lg btn-block btn-info',
					'label' => 'Нажмите здесь, забавная штука!',
				]
			]);

			echo 'Надо взять на вооружение.';

			Modal::end();


echo "The End";


?>









