<?php
	/**
	 * Created by PhpStorm.
	 * User: USER
	 * Date: 17.03.2017
	 * Time: 17:50
	 */

use yii\bootstrap\Modal;
	use yii\bootstrap\Progress;





	Modal::begin([
		'header' => '<h2>Завантаження даних...</h2>',
		'options'=>[
			'id'=>'Modalprogress'

		],
		'size'=> 'modal-lg',
//		'toggleButton' => [
//
//
//			'tag' => 'button',
//			'class' => 'advisor ',
//			'label' => 'Нажмите здесь, забавная штука!',
//		]
	]);
	echo "<script src=".'app/media/js/import-dbf.js'." type=".'text/javascript'."></script>";


	//	echo 'Завантаження даних...';

	$progres = Progress::widget([
		'percent' => 10,

		'barOptions' => [
			'class' => 'progress-bar-success'
		],
		'options' => [
			'class' => 'active progress-striped'
		]
	]);
	echo $progres;


	//	$model = new UploadForm();
	//	$this->render('ImportProgress', ['model' => $model]);


	Modal::end();

?>









