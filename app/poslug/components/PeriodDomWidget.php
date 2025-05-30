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


class PeriodDomWidget extends Widget
{
	public $dataProvider;
	public $searchModel;
	public $columns;
	public $model;



	public function init()
	{
		parent::init();

        $session = Yii::$app->session;

		$ModelPeriod = new Period();
//		$lastperiod = UtPeriod::find()->select('period')->where(['ut_period.imp_km' => 1])->orderBy(['period' => SORT_DESC])->one();
//		$lastperiod = UtPeriod::find()->select('period')->orderBy(['period' => SORT_DESC])->one();
        $allperiod = Yii::$app->dolgdb->createCommand('select period from period order by period desc')->QueryAll();
        $periodnow = $allperiod[0]["period"];
        $lastperiod =$allperiod[1]["period"];
        array_splice($allperiod, 0, 1);

		$ModelPeriod->lastperiod = $lastperiod;
//		if ($ModelPeriod->load(Yii::$app->request->queryParams))
//		if ($ModelPeriod->load(Yii::$app->request->post()))
//		{
//				Yii::$app->session['periodsite']=$ModelPeriod->periodsite;
//		}
//		else
//		{
			if (Yii::$app->session['perioddom']==null)
			{

                $session['perioddom']=$lastperiod;
				$ModelPeriod->perioddom=$lastperiod;
			}
			else
			{
				$ModelPeriod->perioddom=Yii::$app->session['perioddom'];
			}
//		}


		$value=false;

		if (isset(Yii::$app->session['periodspisoksite']))
			$value = isset(Yii::$app->session['periodspisoksite']) ?  ArrayHelper::keyExists($lastperiod, Yii::$app->session['periodspisoksite'][\Yii::$app->formatter->asDate($lastperiod, 'php:Y')], false) : false ;


//		$value = isset(Yii::$app->session['periodspisoksite']) ?  ArrayHelper::keyExists($lastperiod->period, Yii::$app->session['periodspisoksite'][\Yii::$app->formatter->asDate($lastperiod->period, 'php:Y')], false) : false ;

		if (!$value)
		{
			$per = [];
//			$ar  = UtPeriod::find()->select('period')->where(['ut_period.imp_km' => 1])->orWhere(['ut_period.imp_kp' => 1])->orderBy(['period' => SORT_DESC])->all();
            $ar  = $allperiod;
			$dat = ArrayHelper::map($ar, 'period', 'period');
			foreach ($dat as $dt)
			{
				$val=ArrayHelper::getValue($per, Yii::$app->formatter->asDate($dt, 'php:Y'));
				if ($val==null)
				{
					ArrayHelper::setValue($per, Yii::$app->formatter->asDate($dt, 'php:Y'), [$dt => Yii::$app->formatter->asDate($dt, 'LLLL')]);
				}
				else
				{
					ArrayHelper::setValue($per, [Yii::$app->formatter->asDate($dt, 'php:Y'),$dt], Yii::$app->formatter->asDate($dt, 'LLLL'));

				}
			}

            $session['periodspisoksite']=$per;
		}




		$this->model = $ModelPeriod;






	}

	public function run()
	{


		$text = $_SESSION['perioddom']==$this->model->lastperiod ? 'Поточний період' : 'Архів' ;

		$form = ActiveForm::begin([
			'id' => 'Periodform',
//			'layout'=>'inline',
//			'action' => ['index'],
//			'method' => 'post',
			'options' => [
				'data-pjax' => 1,
//				'class' => 'form-inline',
			]

		]);




	echo $form->field($this->model, 'perioddom')->dropDownList(Yii::$app->session['periodspisoksite'],
			[

				'onchange'=>'Butperioddomform.click(),
				SavePeriod(this.value)',
//			'onchange'=>'SavePeriod(this.value)',
				['options' =>
					 [
//						 $this->model->periodoblik => ['selected' => true]
					 ]
				]
			])
//		->label($text);
?>

        <?= Html::submitButton('', ['id'=>'Butperioddomform','hidden']) ?>


 <?php ActiveForm::end();


	}
}


?>
<script type="text/javascript">
	function SavePeriod(per)
	{
		$.ajax({
			url: "/site/saveperioddom",
			type: 'post',
			data: {	period: per	},
			success: function(s) {
//				alert(s);
			}

		});
	}


</script>


