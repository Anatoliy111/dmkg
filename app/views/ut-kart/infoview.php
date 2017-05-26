<?php


	use kartik\nav\NavX;
	use yii\bootstrap\Nav;
	use yii\bootstrap\NavBar;
	use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;
use yii\helpers\Url;
	use yii\bootstrap\Tabs;
	use yii\bootstrap\Dropdown;
	use yii\bootstrap\ActiveForm;
	use yii\widgets\Menu;

	//	use yii\bootstrap\

/* @var $this yii\web\View */


?>



	<?php $this->beginContent('@app/views/ut-kart/navbar.php',['model'=>$model]); ?>

<div class="utkart-info-view">




	<?= ListView::widget([
		'dataProvider' => $dataProvider,
		'pager' => [
		],
		'options' => [
			'tag' => 'div',
			'id' => 'case-notes-wrapper',
			'class' => 'case-notes-wrapper'
		],
		'layout' => "{items}\n{pager}",
		'itemView' => 'infodetail',
		'emptyText' => '',
	]); ?>






</div>

	<?php $this->endContent(); ?>



