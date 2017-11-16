<?php

use yii\helpers\Html;
	use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\poslug\SearchUtAuth */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('easyii', 'Заявки на реєстрацію');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-auth-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('easyii', 'Create Ut Auth'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
			['class' => '\kartik\grid\SerialColumn'],

            'date',
            'fio_p',
            'fio_i',
             'fio_b',
            // 'passw',
            // 'telef',
             'email:email',
             'status',

			[
				'class' => '\kartik\grid\ActionColumn',
				'viewOptions' => ['button' => '<i class="glyphicon glyphicon-eye-open"></i>'],
				'deleteOptions' => ['label' => '<i class="glyphicon glyphicon-remove"></i>']
			]
        ],
		'pjax'=>true,
		'pjaxSettings'=>[
			'neverTimeout'=>true,
//			'beforeGrid'=>'My fancy content before.',
//			'afterGrid'=>'My fancy content after.',
		],

    ]); ?>
    <?php Pjax::end(); ?>
</div>
