<?php
	/**
	 * Created by PhpStorm.
	 * User: USER
	 * Date: 22.03.2017
	 * Time: 0:10
	 */
namespace app\poslug\models;

 use Yii;
 use yii\base\Model;


	class Period extends Model
	{
		public $periodsite;
		public $periodoblik;
		public $lastperiod;

		public function rules()
		{
			return [
				[['periodoblik','periodsite','lastperiod'], 'safe'],
			];
		}

		public function attributeLabels()
		{
			return [
				'periodsite' => Yii::t('easyii', 'Periodsite'),
				'periodoblik' => Yii::t('easyii', 'Periodoblik'),
			];
		}
	}