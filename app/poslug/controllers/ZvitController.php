<?php

namespace app\poslug\controllers;

use app\poslug\models\UtNarah;
use app\poslug\models\UtObor;
use yii\data\ActiveDataProvider;

class ZvitController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

	public function actionZvedsubs()
	{
//		$model =

		return $this->render('index');
	}

	public function actionZvednarah()
	{
		$model = UtNarah::find()->select('period, tipposl, sum(sum) as sum')->groupBy('period,tipposl');
		$dataProvider = new ActiveDataProvider([
			'query' => $model,
		]);

		return $this->render('zvednarah', [
			'model' => $model,
			'dataProvider' => $dataProvider,
		]);

	}

	public function actionZvedobor()
	{
//		select('period, tipposl, dolg, sum(nach), sum(subs), sum(opl), sum(uder), sum(sal)')->
		$model = UtObor::find()->select('period, tipposl, sum(dolg) as dolg, sum(nach) as nach, sum(subs) as subs, sum(opl) as opl, sum(sal) as sal')->groupBy('period,tipposl');
		$dataProvider = new ActiveDataProvider([
			'query' => $model,
		]);

		return $this->render('zvedobor', [
			'model' => $model,
			'dataProvider' => $dataProvider,
		]);
	}

	public function actionZvedopl()
	{
		return $this->render('index');
	}

}
