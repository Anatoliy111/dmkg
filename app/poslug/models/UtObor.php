<?php

namespace app\poslug\models;

use kartik\builder\TabularForm;
use Yii;

/**
 * This is the model class for table "ut_obor".
 *
 * @property int $id
 * @property int $id_org
 * @property string $period
 * @property int $id_kart
 * @property int $id_posl
 * @property string $tipposl
 * @property double $dolg
 * @property double $nach
 * @property double $subs
 * @property double $opl
 * @property double $pere
 * @property double $sal
 *
 * @property UtOrg $org
 * @property UtAbonent $abonent
 * @property UtPosl $posl
 */
class UtObor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $dolgopl;
    public $sendopl;


    public static function tableName()
    {
        return 'ut_obor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_org', 'period', 'id_kart'], 'required'],
            [['id_org', 'id_kart', 'id_posl'], 'integer'],
            [['period'], 'safe'],
			[['tipposl'], 'string', 'max' => 64],
            [['dolg', 'nach', 'subs', 'opl', 'pere', 'sal','dolgopl','sendopl'], 'number'],
            [['id_org'], 'exist', 'skipOnError' => true, 'targetClass' => UtOrg::className(), 'targetAttribute' => ['id_org' => 'id']],
            [['id_kart'], 'exist', 'skipOnError' => true, 'targetClass' => UtAbonent::className(), 'targetAttribute' => ['id_kart' => 'id']],
            [['id_posl'], 'exist', 'skipOnError' => true, 'targetClass' => UtPosl::className(), 'targetAttribute' => ['id_posl' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('easyii', 'ID'),
            'id_org' => Yii::t('easyii', 'Id Org'),
            'period' => Yii::t('easyii', 'Period'),
            'id_kart' => Yii::t('easyii', 'Id Kart'),
            'id_posl' => Yii::t('easyii', 'Id Posl'),
			'tipposl' => Yii::t('easyii', 'Tipposl'),
            'dolg' => Yii::t('easyii', 'Dolg'),
            'nach' => Yii::t('easyii', 'Nach'),
            'subs' => Yii::t('easyii', 'Subs'),
            'opl' => Yii::t('easyii', 'Opl'),
            'pere' => Yii::t('easyii', 'Pere'),
            'sal' => Yii::t('easyii', 'Sal'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrg()
    {
        return $this->hasOne(UtOrg::className(), ['id' => 'id_org']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKart()
    {
        return $this->hasOne(UtAbonent::className(), ['id' => 'id_kart']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosl()
    {
        return $this->hasOne(UtPosl::className(), ['id' => 'id_posl']);
    }

    public function sort()
    {
        $this->orderBy(['period' => SORT_DESC]);
        return $this;
    }

    public function getFormAttribs() {
        return [
            // primary key column
//			'id'=>[ // primary key attribute
//				'type'=>TabularForm::INPUT_HIDDEN,
//				'columnOptions'=>['hidden'=>true]
//			],'st_ul'
            'dolgopl'=>['type'=>TabularForm::INPUT_TEXT],
            'sendopl'=>['type'=>TabularForm::INPUT_TEXT],
//			'publish_date'=>[
//				'type' => function($model, $key, $index, $widget) {
//					return ($key % 2 === 0) ? TabularForm::INPUT_HIDDEN : TabularForm::INPUT_WIDGET;
//				},
//				'widgetClass'=>\kartik\widgets\DatePicker::classname(),
//				'options'=> function($model, $key, $index, $widget) {
//					return ($key % 2 === 0) ? [] :
//						[
//							'pluginOptions'=>[
//								'format'=>'yyyy-mm-dd',
//								'todayHighlight'=>true,
//								'autoclose'=>true
//							]
//						];
//				},
//				'columnOptions'=>['width'=>'170px']
//			],
//			'color'=>[
//				'type'=>TabularForm::INPUT_WIDGET,
//				'widgetClass'=>\kartik\widgets\ColorInput::classname(),
//				'options'=>[
//					'showDefaultPalette'=>false,
//					'pluginOptions'=>[
//						'preferredFormat'=>'name',
//						'palette'=>[
//							[
//								"white", "black", "grey", "silver", "gold", "brown",
//							],
//							[
//								"red", "orange", "yellow", "indigo", "maroon", "pink"
//							],
//							[
//								"blue", "green", "violet", "cyan", "magenta", "purple",
//							],
//						]
//					]
//				],
//				'columnOptions'=>['width'=>'150px'],
//			],
//
//			'author_id'=>[
//				'type'=>TabularForm::INPUT_DROPDOWN_LIST,
//				'items'=>ArrayHelper::map(Author::find()->orderBy('name')->asArray()->all(), 'id', 'name'),
//				'columnOptions'=>['width'=>'185px']
//			],
            /*
            'buy_amount'=>[
                'type'=>TabularForm::INPUT_TEXT,
                'label'=>'Buy',
                'options'=>['class'=>'form-control text-right'],
                'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT, 'width'=>'90px']
            ],
            */
//			'sell_amount'=>[
//				'type'=>TabularForm::INPUT_STATIC,
//				'label'=>'Sell',
//				'columnOptions'=>['hAlign'=>GridView::ALIGN_RIGHT, 'width'=>'90px']
//			],
        ];
    }
}
