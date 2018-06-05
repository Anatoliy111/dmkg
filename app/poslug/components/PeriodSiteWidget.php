<?php
	/**
	 * Created by PhpStorm.
	 * User: USER
	 * Date: 31.05.2018
	 * Time: 23:35
	 */

namespace app\poslug\components;

use app\poslug\models\Period;
	use app\poslug\models\UtTarif;
	use app\poslug\models\UtTarifplan;
use kartik\select2\Select2;
use Yii;
use yii\base\Widget;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;


class PeriodSiteWidget extends Widget
{
	public $dataProvider;
	public $searchModel;
	public $columns;
	public $model;



	public function init()
	{
		parent::init();
		$ModelPeriod = new Period();
		$lastperiod = UtTarif::find()->select('period')->groupBy('period')->orderBy(['period' => SORT_DESC])->one();
		$ModelPeriod->lastperiod = $lastperiod->period;
//		if ($ModelPeriod->load(Yii::$app->request->queryParams))
		if ($ModelPeriod->load(Yii::$app->request->post()))
		{
				Yii::$app->session['periodsite']=$ModelPeriod->periodsite;
		}
		else
		{
			if (Yii::$app->session['periodsite']==null)
			{

				Yii::$app->session['periodsite']=$lastperiod->period;
				$ModelPeriod->periodoblik=$lastperiod->period;
			}
			else
			{
				$ModelPeriod->periodoblik=Yii::$app->session['periodsite'];
			}
		}


		$value = isset(Yii::$app->session['periodspisoksite']) ?  ArrayHelper::keyExists($lastperiod->period, Yii::$app->session['periodspisoksite'][\Yii::$app->formatter->asDate($lastperiod->period, 'php:Y')], false) : false ;

		if (!$value)
		{
			$per = [];
			$ar  = UtTarif::find()->groupBy(['period'])->orderBy(['period' => SORT_DESC])->all();
			$dat = ArrayHelper::map($ar, 'period', 'period');
			foreach ($dat as $dt)
			{
				$val=ArrayHelper::getValue($per, Yii::$app->formatter->asDate($dt, 'Y'));
				if ($val==null)
				{
					ArrayHelper::setValue($per, Yii::$app->formatter->asDate($dt, 'Y'), [$dt => Yii::$app->formatter->asDate($dt, 'LLLL')]);
				}
				else
				{
					ArrayHelper::setValue($per, [Yii::$app->formatter->asDate($dt, 'Y'),$dt], Yii::$app->formatter->asDate($dt, 'LLLL'));

				}
			}

			Yii::$app->session['periodspisoksite']=$per;
		}




		$this->model = $ModelPeriod;






	}

	public function run()
	{

		$form = ActiveForm::begin([
			'id' => 'periodsite-form',
//			'layout'=>'inline',
//			'action' => ['index'],
			'method' => 'post',
			'options' => [
//				'data-pjax' => 1,
//				'class' => 'form-inline',
			]

		]);




	echo $form->field($this->model, 'periodsite')->dropDownList(Yii::$app->session['periodspisoksite'],
			[

				'onchange'=>'this.form.submit(),
				SavePeriod(this.value)',
				['options' =>
					 [
//						 $this->model->periodoblik => ['selected' => true]
					 ]
				]
			])->label('Період');

 ActiveForm::end();


	}
}


?>
<script type="text/javascript">
	function SavePeriod(per)
	{
		$.ajax({
			url: "/poslug/default/saveperiodsite",
			type: 'post',
			data: {	period: per	},
			success: function(s) {
//				alert(s);
			}

		});
	}


</script>


