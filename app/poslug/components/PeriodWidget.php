<?php
	/**
	 * Created by PhpStorm.
	 * User: USER
	 * Date: 31.05.2018
	 * Time: 23:35
	 */

namespace app\poslug\components;

use app\poslug\models\Period;
use app\poslug\models\UtPeriod;
use app\poslug\models\UtTarifplan;
use kartik\select2\Select2;
use Yii;
use yii\base\Widget;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;


class PeriodWidget extends Widget
{
	public $dataProvider;
	public $searchModel;
	public $columns;
	public $model;



	public function init()
	{
		parent::init();
		$ModelPeriod = new Period();
		$lastperiod = UtPeriod::find()->select('period')->orderBy(['period' => SORT_DESC])->one();

		$ModelPeriod->lastperiod = $lastperiod->period;
		if ($ModelPeriod->load(Yii::$app->request->queryParams))
		{
				Yii::$app->session['periodoblik']=$ModelPeriod->periodoblik;
		}
		else
		{
			if (Yii::$app->session['periodoblik']==null)
			{

				Yii::$app->session['periodoblik']=$lastperiod->period;
				$ModelPeriod->periodoblik=$lastperiod->period;
			}
			else
			{
				$ModelPeriod->periodoblik=Yii::$app->session['periodoblik'];
			}
		}
		$value=false;

		if (isset(Yii::$app->session['periodspisoksite']))
		    $value = isset(Yii::$app->session['periodspisok']) ?  ArrayHelper::keyExists($lastperiod->period, Yii::$app->session['periodspisok'][\Yii::$app->formatter->asDate($lastperiod->period, 'php:Y')], false) : false ;



		if (!$value)
		{
			$per = [];
			$ar  = UtPeriod::find()->select('period')->where(['ut_period.imp_km' => 1])->orWhere(['ut_period.imp_kp' => 1])->orderBy(['period' => SORT_DESC])->all();
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

			Yii::$app->session['periodspisok']=$per;
		}




		$this->model = $ModelPeriod;






	}

	public function run()
	{

		$form = ActiveForm::begin([
			'id' => 'period-form',
			'layout'=>'inline',
//			'action' => ['index'],
			'method' => 'post',
			'options' => [
//				'data-pjax' => 1,
//				'class' => 'form-inline',
			]

		]);




	echo $form->field($this->model, 'periodoblik')->dropDownList(Yii::$app->session['periodspisok'],
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
			url: "/poslug/default/saveperiod",
			type: 'post',
			data: {	period: per	},
			success: function(s) {
//				alert(s);
			}

		});
	}


</script>


