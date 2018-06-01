<?php
	/**
	 * Created by PhpStorm.
	 * User: USER
	 * Date: 22.03.2017
	 * Time: 0:10
	 */
namespace app\poslug\models;

 use yii\base\Model;


	class Period extends Model
	{
		public $periodsite;
		public $periodoblik;

		public function rules()
		{
			return [
				[['periodoblik','periodsite'], 'safe'],
			];
		}
	}