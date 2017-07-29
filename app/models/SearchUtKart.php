<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\bootstrap\Alert;
use yii\data\ActiveDataProvider;
use app\models\UtKart;

/**
 * SearchUtKart represents the model behind the search form of `app\models\UtKart`.
 */
class SearchUtKart extends UtKart
{
    /**
     * @inheritdoc
     */
	public $enterpass;
	const SCENARIO_ADDR = 'adres';
	const SCENARIO_PASS = 'password';


    public function rules()
    {
        return [
			[['dom', 'id_ulica','enterpass'], 'required'],
            [['id', 'id_ulica', 'kv', 'ur_fiz', 'id_oldkart'], 'integer'],
            [['name_f', 'name_i', 'name_o', 'fio', 'idcod', 'dom', 'korp', 'pass', 'telef'], 'safe'],
			[['enterpass'], 'string', 'min' => 7],
//			[['enterpass'], 'compare',  'compareValue' => $this->pass.'111', 'operator' => '==', 'message' => 'Код доступу не вірний !'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
//        return Model::scenarios();
//		return [
//			self::SCENARIO_ADDR => ['dom', 'id_ulica'],
//			self::SCENARIO_PASS => ['dom', 'id_ulica','enterpass'],
//		];

		$scenarios = parent::scenarios();
		$scenarios[self::SCENARIO_ADDR] = ['dom', 'id_ulica', 'kv', 'korp'];
		$scenarios[self::SCENARIO_PASS] = ['dom', 'id_ulica', 'kv', 'korp', 'enterpass'];
		return $scenarios;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = UtKart::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
             $query->where('0=1');
            return $dataProvider;
        }

		$Get = Yii::$app->request->get('SearchUtKart');

		if (($Get['kv']==null) or ($Get['kv']=="") or ($Get['kv']==0))
		{
			$this->kv=1;
		}
		$query->andWhere([
			'id_ulica' => $this->id_ulica,
			'kv' => $this->kv,
		]);

		if ($Get['korp']<>null)
		{
			$this->korp=$Get['korp'];
			$domkorp = $Get['dom'].$Get['korp'];
			$query->andWhere(['=', 'dom', $domkorp]);
		}
		else {
			$this->korp=null;
			$query->andWhere(['=', 'dom', $this->dom]);
		}

//		if ($this->enterpass<>null){
//			$query->andWhere(['=', 'pass', $this->enterpass]);
//			if ($dataProvider->getTotalCount() <> 0) {
//				return $dataProvider->getModels()[0];
//			}
//		}


//		if ($dataProvider->getTotalCount() == 0) {
////			Yii::$app->getSession()->setFlash('alert', [
////				'body'=>'Thank you for contacting us. We will respond to you as soon as possible.',
////				'options'=>['class'=>'alert-warning']
////			]);
//			Alert::begin([
//				'options' => [
//					'class' => 'alert-danger', 'style' => 'float:bottom; margin-top:50px',
//				],
//			]);
//
//			echo 'По вашій адресі абонентів не знайдено ';
//
//			Alert::end();
//		}






//        // grid filtering conditions
//        $query->andFilterWhere([
//            'id' => $this->id,
//            'id_ulica' => $this->id_ulica,
//            'kv' => $this->kv,
//            'ur_fiz' => $this->ur_fiz,
//            'id_oldkart' => $this->id_oldkart,
//        ]);
//
//        $query->andFilterWhere(['like', 'name_f', $this->name_f])
//            ->andFilterWhere(['like', 'name_i', $this->name_i])
//            ->andFilterWhere(['like', 'name_o', $this->name_o])
//            ->andFilterWhere(['like', 'fio', $this->fio])
//            ->andFilterWhere(['like', 'idcod', $this->idcod])
//            ->andFilterWhere(['like', 'dom', $this->dom])
//            ->andFilterWhere(['like', 'korp', $this->korp])
//            ->andFilterWhere(['like', 'pass', $this->pass])
//            ->andFilterWhere(['like', 'telef', $this->telef]);

        return $dataProvider;
    }

	public function searchPass($params, $dataProvider)
	{
		$this->load($params);
		if (!$this->validate()) {
			return null;
		}
        $models = $dataProvider->getModels();
        foreach($models as $model){
           if ($model->pass == $this->enterpass){
			   return $model;
		   }
		}


		return 'bad';
	}
}
