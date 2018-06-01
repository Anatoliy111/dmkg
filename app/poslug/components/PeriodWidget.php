<?php
	/**
	 * Created by PhpStorm.
	 * User: USER
	 * Date: 31.05.2018
	 * Time: 23:35
	 */

namespace app\poslug\components;

use app\poslug\models\Period;
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
	public $modelmames;
	public $model;


	public function init()
	{
		parent::init();
		$ModelPeriod = new Period();
		$lastperiod = UtTarifplan::find()->select('period')->groupBy('period')->orderBy(['period' => SORT_DESC])->one();

		if ($ModelPeriod->load(Yii::$app->request->queryParams))
		{

			if (Yii::$app->session['periodoblik']==null)
			{
				Yii::$app->session['periodoblik']=$ModelPeriod->periodoblik;
			}
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
		$kk  = ArrayHelper::keyExists($lastperiod->period, Yii::$app->session['periodspisok'], false);
		$TT  = ArrayHelper::isIn($lastperiod->period, Yii::$app->session['periodspisok']);
		$value = isset(Yii::$app->session['periodspisok']) ?  ArrayHelper::keyExists($lastperiod->period, Yii::$app->session['periodspisok'], true) : false ;
		if (!$value)
		{
			$per = [];
			$ar  = UtTarifplan::find()->orderBy(['period' => SORT_DESC])->all();
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

//		$pp = $this->model->period;

//		return $this->render('views\period', ['model' => $model]);


//			if ($this->message === null) {
//				$this->message = 'Hello World';
//			}
//
//			$this->searchModel

	}

	public function run()
	{

		$form = ActiveForm::begin([
			'id' => 'period-form',
			'layout'=>'horizontal',
//			'action' => ['index'],
			'method' => 'get',
			'options' => [
				'data-pjax' => 1,
//				'class' => 'form-inline',
			]

		]);

	echo $form->field($this->model, 'periodoblik')->widget(Select2::classname(), [
	'data' => Yii::$app->session['periodspisok'],
	'language' => 'uk',
		'hideSearch' => true,
	'options' => ['onchange'=>'this.form.submit()',],

	'pluginOptions' => [
		'allowClear' => true
	],
])->label('Період');


 ActiveForm::end();


	}
}
?>