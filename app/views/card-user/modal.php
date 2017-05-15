<?php
	/**
	 * Created by PhpStorm.
	 * User: USER
	 * Date: 11.03.2017
	 * Time: 20:18
	 */
use	yii\bootstrap\Modal;


 Modal::begin([
						'header' => '<h2>Вот это модальное окно!</h2>',
						'toggleButton' => [
						'tag' => 'button',
						'class' => 'advisor ',
						'label' => 'Нажмите здесь, забавная штука!',
						]
						]);

						echo 'Надо взять на вооружение.';

						Modal::end();
						?>