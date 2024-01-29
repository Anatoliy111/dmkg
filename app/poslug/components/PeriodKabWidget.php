<?php
	/**
	 * Created by PhpStorm.
	 * User: USER
	 * Date: 31.05.2018
	 * Time: 23:35
	 */

namespace app\poslug\components;

use app\models\DolgPeriod;
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
        $session = Yii::$app->session;
		$ModelPeriod = new Period();
//		$lastperiod = DolgPeriod::find()->select('period')->orderBy(['period' => SORT_DESC])->one();
        $lastperiod = Yii::$app->dolgdb->createCommand('select period from period order by period desc')->QueryAll()[0];
        $lastperiodarc = Yii::$app->dolgdb->createCommand('select period from period order by period desc')->QueryAll()[1];
		$ModelPeriod->lastperiod = $lastperiod["period"];
//		if ($ModelPeriod->load(Yii::$app->request->queryParams))
//		if ($ModelPeriod->load(Yii::$app->request->post()))
//		{
//				Yii::$app->session['periodsite']=$ModelPeriod->periodsite;
//		}
//		else
//		{
			if (Yii::$app->session['periodkab']==null)
			{

                $session['periodkab']=$lastperiod["period"];
				$ModelPeriod->periodkab=$lastperiod["period"];
			}
			else
			{
				$ModelPeriod->periodkab=Yii::$app->session['periodkab'];
			}
//		}

		$value=false;

		if (isset(Yii::$app->session['periodspisoksite']))
//		    if (ArrayHelper::keyExists(Yii::$app->formatter->asDate($lastperiod["period"], 'php:Y'), Yii::$app->session['periodspisoksite'], false))
			   $value = isset(Yii::$app->session['periodspisoksite']) ?  ArrayHelper::keyExists($lastperiodarc["period"], Yii::$app->session['periodspisoksite'][\Yii::$app->formatter->asDate($lastperiodarc["period"], 'php:Y')], false) : false ;



//		$value = isset(Yii::$app->session['periodspisoksite']) ?  ArrayHelper::keyExists($lastperiod->period, Yii::$app->session['periodspisoksite'][\Yii::$app->formatter->asDate($lastperiod->period, 'php:Y')], false) : false ;

		if (!$value)
		{
			$per = [];
//			$ar  = DolgPeriod::find()->select('period')->where(['<>','period',$lastperiod->period])->orderBy(['period' => SORT_DESC])->limit(24)->all();
            $ar  = Yii::$app->dolgdb->createCommand('select first 24 period from period where period<>\''.$lastperiod["period"].'\'  order by period desc')->QueryAll();
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


