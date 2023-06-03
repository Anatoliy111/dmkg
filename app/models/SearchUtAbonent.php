<?php

namespace app\models;

use app\models\UtAbonent;
use yii\base\BaseObject;
use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * SearchUtAbonent represents the model behind the search form of `app\models\UtAbonent`.
 */
class SearchUtAbonent extends UtAbonent
{
    /**
     * {@inheritdoc}
     */
    public $pass1;
    public $pass2;

    const SCENARIO_AUTH = 'auth';
    const SCENARIO_REG = 'reg';
    const SCENARIO_EMAIL = 'email';

    public function rules()
    {
        return [
            [['id', 'del', 'status'], 'integer'],
            [['date_pass', 'passopen', 'telef'], 'safe'],
            [['fio', 'email', 'pass1','pass2','pass'], 'required'],
            [['pass1','pass2','pass'], 'string', 'min' => 5],
            ['email', 'email'],
            [['fio', 'pass', 'email'], 'string', 'max' => 64],
            [['email'], 'exist', 'skipOnError' => true, 'targetClass' => UtAbonent::class, 'targetAttribute' => ['email' => 'email'],'message' => 'Email не зареєстрований!!!','on' => self::SCENARIO_EMAIL],
            [['email'], 'exist', 'skipOnError' => true, 'targetClass' => UtAbonent::class, 'targetAttribute' => ['email' => 'email'],'message' => 'Email не зареєстрований!!!','on' => self::SCENARIO_AUTH],
            [['email'], 'unique', 'skipOnError' => true, 'targetClass' => UtAbonent::class, 'targetAttribute' => ['email' => 'email'],'message' => 'Email вже зареєстрований!!!','on' => self::SCENARIO_REG],
            ['pass2', 'compare',  'compareAttribute' => 'pass1', 'message' => 'Паролі не співпадають!!!'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
//        return Model::scenarios();
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_AUTH] = ['email', 'pass'];
        $scenarios[self::SCENARIO_REG] = ['fio','pass1','pass2','email'];
        $scenarios[self::SCENARIO_EMAIL] = ['email'];
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
        $query = UtAbonent::find();

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
            'date_pass' => $this->date_pass,
            'del' => $this->del,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'fio', $this->fio])
            ->andFilterWhere(['like', 'pass', $this->pass])
            ->andFilterWhere(['like', 'passopen', $this->passopen])
            ->andFilterWhere(['like', 'telef', $this->telef])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }

    public function searchauth($params)
    {
        $query = UtAbonent::find();

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

        // grid filtering conditions

        $query->FilterWhere(['like', 'passopen', $this->pass])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }

    public function searchemail($params)
    {
        $query = UtAbonent::find();

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

        // grid filtering conditions

        $query->FilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
