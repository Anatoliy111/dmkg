<?php

namespace app\poslug\models;

use Yii;
use yii\base\BaseObject;
use yii\base\Model;
use yii\bootstrap\Alert;
use yii\data\ActiveDataProvider;
use yii\web\IdentityInterface;


/**
 * SearchDolgKart represents the model behind the search form of `app\models\UtKart`.
 */
class SearchDolgOborNow extends DolgOborNow
{
	/**
     * @inheritdoc
     */
	public $enterpass;
    public $abonents;

	const SCENARIO_ADDR = 'adres';
    const SCENARIO_RAH = 'rahunok';
    const SCENARIO_FIO = 'fio';
    const SCENARIO_UL = 'ul';

//    const SCENARIO_NF = 'name_f';



    public function rules()
    {
        return [
            [['nomdom', 'kl_ul','schet','fio'], 'required'],
            [['schet'], 'string', 'min' => 7],
            [['period', 'fio'], 'string'],
            [['nomkv'], 'safe'],
            [['schet'], 'exist', 'skipOnError' => true, 'targetClass' => DolgKart::class, 'targetAttribute' => ['schet' => 'schet'],'message' => 'Рахунок не зареєстрований!!!','on' => self::SCENARIO_RAH],
            [['fio'], 'exist', 'skipOnError' => true, 'targetClass' => DolgKart::class, 'targetAttribute' => ['fio' => 'fio'],'message' => 'Абонент з таким прізвищем не зареєстрований!!!','on' => self::SCENARIO_RAH],
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
		$scenarios[self::SCENARIO_ADDR] = ['nomdom', 'kl_ul', 'nomkv'];
        $scenarios[self::SCENARIO_UL] = ['kl_ul'];
        $scenarios[self::SCENARIO_RAH] = ['schet'];
        $scenarios[self::SCENARIO_FIO] = ['fio'];
        return $scenarios;
    }

//    public function attributeLabels()
//    {
//        return [
//            'enterpass' => 'Введіть пароль',
//        ];
//    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchul($params)
    {

        $period=DolgPeriod::find()->select('period')->orderBy(['period' => SORT_DESC])->one()->period;

        $query = DolgOborNow::find();
        $query->where(['period' => $period, 'wid' => 'sm']);
//        $query->orderBy('npp');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
            'sort' => [
                'defaultOrder' => [
                    'ndom' => SORT_ASC,
                    'nomdom' => SORT_ASC,
                    'nomkv' => SORT_ASC,
                ]
            ],
        ]);

        $this->load($params);

//        $this->kl_ul=iconv('UTF-8','windows-1251', $this->nomdom);
//        $this->nomkv=iconv('UTF-8','windows-1251', $this->nomkv);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
             $query->andWhere('0=1');
            return $dataProvider;
        }

//		$Get = Yii::$app->request->get('SearchDolgObor');
//
//		if (($Get['nomkv']==null) or ($Get['nomkv']=="") or ($Get['nomkv']==0))
//		{
//			$this->nomkv='';
//		}
		$query->andWhere([
			'kl_ul' => $this->kl_ul,
		]);

//		if ($Get['korp']<>null)
//		{
//			$this->korp=$Get['korp'];
//			$domkorp = $Get['dom'].$Get['korp'];
//			$query->andWhere(['=', 'dom', $domkorp]);
//		}
//		else {
//			$this->korp=null;
//			$query->andWhere(['=', 'nomdom', $this->nomdom]);
//		}

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

    public function searchrah($params)
    {
        $query = UtKart::find();

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

        $query->andFilterWhere(['like', 'fio', $this->name_f])
            ->andFilterWhere(['like', 'schet', $this->schet]);

        return $dataProvider;
    }


	public function searchPass($params, $dataProvider)
	{
		$this->load($params);
        $this->nomdom=iconv('UTF-8','windows-1251', $this->nomdom);
        $this->nomkv=iconv('UTF-8','windows-1251', $this->nomkv);
		if (!$this->validate()) {
			return null;
		}
        $models = Yii::$app->dolgdb->createCommand('select * from kart where kl_ul=\''.$this->kl_ul.'\' and nomdom=\''.$this->nomdom.'\' and nomkv=\''.$this->nomkv.'\'')->QueryAll();


//        $models = $dataProvider->getModels();
//		$models = $this->findByUsers($this->id_ulica,$this->dom,$this->kv);
        foreach($models as $model){

//           $abons =  $model->getAbonents();

            $modekKart = DolgKart::find()->where(['schet' => trim($model["schet"])])->all()[0];

            $abons =  $modekKart->getAbonents();

            foreach($abons as $abon){

//                if ($abon->pass == md5($model->id.$this->enterpass)){
                if ($abon->passopen == $this->enterpass){
//				Yii::$app->users->login($model->fio);
                    return $abon;
                }

            }


		}


		return 'bad';
	}


	public static function findByUsers($id_ulica,$dom,$kv)
	{
//		return static::findAll(['id_ulica' => $id_ulica, 'dom' => $dom, 'kv' => $kv]);
	}
	/**
	 * Finds an identity by the given ID.
	 * @param string|int $id the ID to be looked for
	 * @return IdentityInterface the identity object that matches the given ID.
	 * Null should be returned if such an identity cannot be found
	 * or the identity is not in an active state (disabled, deleted, etc.)
	 */
//	public static function findIdentity($id)
//	{
//		// TODO: Implement findIdentity() method.
//		return static::findOne(['id' => $id]);
//	}

	/**
	 * Finds an identity by the given token.
	 * @param mixed $token the token to be looked for
	 * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
	 * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
	 * @return IdentityInterface the identity object that matches the given token.
	 * Null should be returned if such an identity cannot be found
	 * or the identity is not in an active state (disabled, deleted, etc.)
	 */
//	public static function findIdentityByAccessToken($token, $type = null)
//	{
//		// TODO: Implement findIdentityByAccessToken() method.
//		throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
//	}

	/**
	 * Returns an ID that can uniquely identify a user identity.
	 * @return string|int an ID that uniquely identifies a user identity.
	 */
//	public function getId()
//	{
//		// TODO: Implement getId() method.
//		return $this->id;
//	}

	public function getSchet()
	{
		// TODO: Implement getId() method.
		return $this->schet;
	}

	/**
	 * Returns a key that can be used to check the validity of a given identity ID.
	 *
	 * The key should be unique for each individual user, and should be persistent
	 * so that it can be used to check the validity of the user identity.
	 *
	 * The space of such keys should be big enough to defeat potential identity attacks.
	 *
	 * This is required if [[User::enableAutoLogin]] is enabled.
	 * @return string a key that is used to check the validity of a given identity ID.
	 * @see validateAuthKey()
	 */
//	public function getAuthKey()
//	{
//		// TODO: Implement getAuthKey() method.
//		return $this->auth_key;
//	}

	/**
	 * Validates the given auth key.
	 *
	 * This is required if [[User::enableAutoLogin]] is enabled.
	 * @param string $authKey the given auth key
	 * @return bool whether the given auth key is valid.
	 * @see getAuthKey()
	 */
//	public function validateAuthKey($authKey)
//	{
//		// TODO: Implement validateAuthKey() method.
//		return $this->getAuthKey() === $authKey;
//	}

//	public function validatePassword($password)
//	{
//		return $this->password === $this->hashPassword($password);
//	}
//
//	private function hashPassword($password)
//	{
//		return sha1($password . $this->getAuthKey() . Setting::get('password_salt'));
//	}
//
//	private function generateAuthKey()
//	{
//		return Yii::$app->security->generateRandomString();
//	}
}
