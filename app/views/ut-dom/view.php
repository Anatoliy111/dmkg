<?php

	use kartik\nav\NavX;
	use kartik\tabs\TabsX;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\NavBar;
	use yii\helpers\ArrayHelper;
	use yii\helpers\Html;
use yii\widgets\DetailView;
	use yii\widgets\Menu;

	/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtDom */
?>

<?php
$ul = $model->getUlica()->one();
$this->title = $ul->ul.' '.$model->n_dom;
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Doms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="ut-dom-view">

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
//    [
//    'label'=>'Акти витрат',
//    'content'=>$this->render('aktview', ['model' => $model,'dataProvider' => $dPzatrat]),
//    ],
	[
		'label'=>'Абоненти по будинку',
		'content'=>$this->render('abview', ['model' => $model,'dataProvider' => $dPabon]),
	],
    ];

	$postId =  Yii::$app->request->post('UtDominfo');

	if ($postId <> null)
	{
		ArrayHelper::setValue($items, '1.active', true);
	}

    echo TabsX::widget([
        'items'=>$items,
        'position'=>TabsX::POS_ABOVE,
        'encodeLabels'=>false,
//		'height'=>TabsX::SIZE_MEDIUM,


        'bordered'=>true,
    ]);

    ?>

<!--    <p>-->
<!--        --><?//= Html::a(Yii::t('easyii', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
<!--        --><?//= Html::a(Yii::t('easyii', 'Delete'), ['delete', 'id' => $model->id], [
//            'class' => 'btn btn-danger',
//            'data' => [
//                'confirm' => Yii::t('easyii', 'Are you sure you want to delete this item?'),
//                'method' => 'post',
//            ],
//        ]) ?>
<!--    </p>-->
<!---->
<!--    --><?//= DetailView::widget([
//        'model' => $model,
//        'attributes' => [
//            'id',
//            'n_dom',
//            'id_ulica',
//            'note:ntext',
//        ],
//    ]) ?>

</div>
