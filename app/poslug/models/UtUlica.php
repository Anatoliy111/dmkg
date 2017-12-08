<?php

namespace app\poslug\models;

use Yii;
use kartik\builder\TabularForm;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ut_ulica".
 *
 * @property int $id
 * @property int $kl
 * @property int $val
 * @property string $ul вулиця
 * @property string $st_ul стара вулиця
 *
 * @property UtDom[] $utDoms
 * @property UtKart[] $utKarts
 * @property UtDomzatrat[] $utDomzatrats
 */
class UtUlica extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_ulica';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ul'], 'required'],
			[['kl','val'], 'integer'],
            [['ul', 'st_ul'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('easyii', 'ID'),
			'kl' => Yii::t('easyii', 'KL'),
            'ul' => Yii::t('easyii', 'Ul'),
            'st_ul' => Yii::t('easyii', 'St Ul'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
	public function getFormAttribs() {
		return [
			// primary key column
//			'id'=>[ // primary key attribute
//				'type'=>TabularForm::INPUT_HIDDEN,
//				'columnOptions'=>['hidden'=>true]
//			],'st_ul'
			'ul'=>['type'=>TabularForm::INPUT_TEXT],
            'st_ul'=>['type'=>TabularForm::INPUT_TEXT],
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





    public function getUtDoms()
    {
        return $this->hasMany(UtDom::className(), ['id_ulica' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtKarts()
    {
        return $this->hasMany(UtKart::className(), ['id_ulica' => 'id']);
    }

	public function getUtDomzatrats()
	{
		return $this->hasMany(UtKart::className(), ['id_ulica' => 'id']);
	}

	public function getUtOldDom()
	{
		return $this->hasMany(UtKart::className(), ['id_ul' => 'id']);
	}
}
