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


class PeriodKabWidget extends Widget
{
	public $dataProvider;
	public $searchModel;
	public $columns;
	public $model;



	public function init()
	{
		parent::init();
		$ModelPeriod = new Period();
		$lastperiod = UtPeriod::find()->select('period')->where(['ut_period.imp_km' => 1])->orderBy(['period' => SORT_DESC])->one();
		$ModelPeriod->lastperiod = $lastperiod->period;
//		if ($ModelPeriod->load(Yii::$app->request->queryParams))
//		if ($ModelPeriod->load(Yii::$app->request->post()))
//		{
//				Yii::$app->session['periodsite']=$ModelPeriod->periodsite;
//		}
//		else
//		{
			if (Yii::$app->session['periodkab']==null)
			{

				Yii::$app->session['periodkab']=$lastperiod->period;
				$ModelPeriod->periodkab=$lastperiod->period;
			}
			else
			{
				$ModelPeriod->periodkab=Yii::$app->session['periodkab'];
			}
//		}


		$value = isset(Yii::$app->session['periodspisoksite']) ?  ArrayHelper::keyExists($lastperiod->period, Yii::$app->session['periodspisoksite'][\Yii::$app->formatter->asDate($lastperiod->period, 'php:Y')], false) : false ;

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

			Yii::$app->session['periodspisoksite']=$per;
		}




		$this->model = $ModelPeriod;






	}

	public function run()
	{


		$text = $_SESSION['periodkab']==$this->model->lastperiod ? 'Поточний період' : 'Архів' ;

		$form = ActiveForm::begin([
			'id' => 'periodform',
//			'layout'=>'inline',
//			'action' => ['index'],
//			'method' => 'post',
			'options' => [
				'data-pjax' => 1,
//				'class' => 'form-inline',
			]

		]);




	echo $form->field($this->model, 'periodkab')->dropDownList(Yii::$app->session['periodspisoksite'],
			[

				'onchange'=>'buttperiod.click(),
				SavePeriod(this.value)',
//			'onchange'=>'SavePeriod(this.value)',
				['options' =>
					 [
//						 $this->model->periodoblik => ['selected' => true]
					 ]
				]
			])
		->label('Розшифровка нарахувань за попередні періоди');
?>

        <?= Html::submitButton('', ['id'=>'buttperiod']) ?>


 <?php ActiveForm::end();


	}
}


?>
<script type="text/javascript">
	function SavePeriod(per)
	{
		$.ajax({
			url: "/site/saveperiodkab",
			type: 'post',
			data: {	period: per	},
			success: function(s) {
//				alert(s);
			}

		});
	}


</script>


