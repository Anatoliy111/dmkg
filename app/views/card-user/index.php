<?php

use app\models;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use	yii\bootstrap\Modal;
use yii\bootstrap\Alert;
	use yii\widgets\DetailView;

//use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CardUserSearch */
/* @var $uupload app\models\UploadForm */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = Yii::t('easyii', 'Card Users');
//$this->params['breadcrumbs'][] = $this->title;

?>
<!--<div class="card-user-index">-->

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->
    <?php



		echo $this->render('_search', ['model' => $searchModel]);

//		echo $this->render('Upload', ['model' => $uupload]); ?>
<!---->
<!--<!--    -->--><?////= ListView::widget([
////        'dataProvider' => $dataProvider,
//////        'itemView' => 'searchview',
////        'itemView' => 'view',
////    ]); ?>
<?php
//	if (isset($DBF))
//	{
//		foreach( $DBF as $field)
//		{
//			echo "<tr>
//				<td>{$field['SCH']}</td>
//				<td>{$field['DOM']}</td>
//				<td>{$field['UL']}</td>
//				<td>{$field['POD']}</td>
//				<td>{$field['RAJON']}</td>
//				<td>{$field['DAY']}</td>
//			</tr>";
//		}
//		echo "</table><br><br>";
//
//	}
//?>




<?= ListView::widget([
	'dataProvider' => $dataProvider,
//        'itemView' => 'searchview',
	'itemView' => 'view',
]);
	if (!isset($this->title)){
//		echo Alert::widget([
//			'options' => [
//				'class' => 'alert-danger'
//			],
//			'body' => '<b>Помилка!</b> По вашій адресі абонентів не знайдено .'
//		]);
//	}
//		Yii::$app->getSession()->setFlash('alert', [
//			'body'=>'Thank you for contacting us. We will respond to you as soon as possible.',
//			'options'=>['class'=>'alert-success'],
//			'false'
//		]);

//	Alert::begin([
//		'options' => [
//			'class' => 'alert-warning',
//		],
//	]);
//
//	echo 'По вашій адресі абонентів не знайдено';
//
//	Alert::end();
//		Yii::$app->session->hasFlash('alert', [
//			'body'=>'По вашій адресі абонентів не знайдено',
//			'options'=>['class'=>'alert-danger']
//		]);
//
//		echo '<div class="alert alert-danger">По вашій адресі абонентів не знайдено</div>';
	}

?>

<!--</div>-->
