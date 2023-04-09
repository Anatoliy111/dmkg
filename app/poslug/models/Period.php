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
		public $perioddom;
		public $periodkab;
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
				'perioddom' => Yii::t('easyii', 'Perioddom'),
				'periodoblik' => Yii::t('easyii', 'Periodoblik'),
			];
		}
	}