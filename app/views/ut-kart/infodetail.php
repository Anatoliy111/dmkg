<?php

	use kartik\builder\Form;
	use kartik\form\ActiveForm;
	use kartik\helpers\Html;
	use yii\bootstrap\Button;

//use yii\widgets\DetailView;
	use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UtKart */

$this->title = $model->fio;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Karts'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-kart-view">






	<div class="row">



		<div class="col-sm-12">
				<?=
					DetailView::widget([
						'model'=>$model,
						'condensed'=>true,
						'hover'=>true,
						'mode'=>DetailView::MODE_VIEW,
						'panel'=>[
//							'heading'=>$model->getOrg()->asArray()->one()['naim'],
							'heading'=>$model->org->naim,
							'headingOptions' => [
								'template' => '{title}',
							],
							'type'=>DetailView::TYPE_INFO,
							'enableEditMode' => false,
						],
						'attributes'=>[
							'schet',
							'fio',
//							[
//								'attribute'=>'id_rabota',
//								'value'=>$model->rabota->name,
//								'visible' => $model->id_rabota<>null ? true : false,
//							],
//							'note',

						]
					]);
				?>
		</div>

	</div>

	<?php




//


	?>



</div>
