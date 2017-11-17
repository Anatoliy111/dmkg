<?php

namespace app\poslug\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\poslug\models\UtAbonent;

/**
 * SearchUtAbonent represents the model behind the search form of `app\poslug\models\UtAbonent`.
 */
class SearchAuthAb extends UtAbonent
{
    /**
     * @inheritdoc
     */
	public $kart;
	public $org;

    public function rules()
    {
        return [
			[['schet'], 'required'],
            [['id', 'id_org', 'schet', 'id_kart'], 'integer'],
            [['note','kart','org'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
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
        $query = UtAbonent::find();

        // add conditions that should always apply here



        $this->load($params);


        // grid filtering conditions
        $query->andFilterWhere([
//            'id' => $this->id,
//            'id_org' => $this->id_org,
            'schet' => $this->schet,
//            'id_kart' => $this->id_kart,
//            'id_oldkart' => $this->id_oldkart,
        ]);




        return $query;
    }
}
