<?php

namespace app\poslug\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\poslug\models\UtLichskl;

/**
 * SearchUtLichskl represents the model behind the search form of `app\poslug\models\UtLichskl`.
 */
class SearchUtLichskl extends UtLichskl
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_org', 'id_abonent', 'id_pokaz'], 'integer'],
            [['period', 'date'], 'safe'],
            [['pokaz_nt1', 'pokaz_nt2', 'pokaz_nt3', 'pokaz_kt1', 'pokaz_kt2', 'pokaz_kt3', 'rizn_t1', 'rizn_t2', 'rizn_t3'], 'number'],
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
        $query = UtLichskl::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_org' => $this->id_org,
            'id_abonent' => $this->id_abonent,
            'id_pokaz' => $this->id_pokaz,
            'period' => $this->period,
            'date' => $this->date,
            'pokaz_nt1' => $this->pokaz_nt1,
            'pokaz_nt2' => $this->pokaz_nt2,
            'pokaz_nt3' => $this->pokaz_nt3,
            'pokaz_kt1' => $this->pokaz_kt1,
            'pokaz_kt2' => $this->pokaz_kt2,
            'pokaz_kt3' => $this->pokaz_kt3,
            'rizn_t1' => $this->rizn_t1,
            'rizn_t2' => $this->rizn_t2,
            'rizn_t3' => $this->rizn_t3,
        ]);

        return $dataProvider;
    }
}
