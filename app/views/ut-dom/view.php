<?php

use app\controllers\UtDomController;
use kartik\nav\NavX;
	use kartik\tabs\TabsX;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\NavBar;
	use yii\helpers\ArrayHelper;
	use yii\helpers\Html;
	use app\poslug\components\PeriodDomWidget;
use yii\widgets\DetailView;
	use yii\widgets\Menu;
	use yii\widgets\Pjax;

	/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtDom */
/** @var $dPtarif UtDomController */
/** @var $dominfo UtDomController */
/** @var $dPnach UtDomController */


?>
<?php Pjax::begin(); ?>
<?php
$ul = $model->getUlica()->one();
$this->title = $ul->ul.' '.$model->n_dom;
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Doms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $ul->ul, 'url' => ['index', 'SearchUtDom'=>['id_ulica' => $ul->id]]];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="well well-large">

	<div class="col-xs-12">

		<div class="col-xs-4 pull-right">

			<?= PeriodDomWidget::widget() ?>
		</div>
	</div>


	<hr/>
	<hr/>
	<hr/>

	<div class="ut-kart">



    <h1><?= Html::encode($this->title) ?></h1>

    <?php




    $items = [
    [
        'label'=>'Тарифи',
        'content'=>$this->render('tarview', ['model' => $model,'dataProvider' => $dPtarif]),
    ],
	[
    	'label'=>'Інформація по будинку',
	    'content'=>$this->render('infoview', ['model' => $model,'dominfo' => $dominfo,]),
	],
	[
		'label'=>'Нарахування',
		'content'=>$this->render('nachview', ['model' => $model,'dataProvider' => $dPnach]),
	],
    ];

//		$postId =  Yii::$app->request->post('UtDominfo');
//
//		if ($postId <> null)
//		{
//			ArrayHelper::setValue($items, '1.active', true);
//		}


    echo TabsX::widget([
        'items'=>$items,
        'position'=>TabsX::POS_ABOVE,
        'encodeLabels'=>false,
        'bordered'=>true,
		'id'=>'dom-tabs',
    ]);

    ?>


	</div>

</div>
<?php Pjax::end(); ?>