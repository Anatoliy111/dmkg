<?php

namespace app\poslug\models;

use Yii;

/**
 * This is the model class for table "ut_oldkart".
 *
 * @property int $id
 * @property string $schet
 * @property string $fio
 * @property string $im
 * @property string $ot
 * @property string $idcod
 * @property string $koli_lg
 * @property int $koli_p
 * @property int $koli_pf
 * @property int $koli_k
 * @property double $plos_bb
 * @property double $plos_ob
 * @property string $priv
 * @property int $etag
 *
 * @property UtAbonent[] $utAbonents
 * @property UtKart[] $utKarts
 */
class UtOldkart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ut_oldkart';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['koli_p', 'koli_pf', 'koli_k', 'etag', 'org'], 'integer'],
            [['plos_bb', 'plos_ob'], 'number'],
            [['schet'], 'string', 'max' => 11],
            [['fio'], 'string', 'max' => 64],
            [['im', 'ot'], 'string', 'max' => 32],
            [['idcod'], 'string', 'max' => 25],
            [['koli_lg'], 'string', 'max' => 10],
            [['priv'], 'string', 'max' => 1],
			[['note'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('easyii', 'ID'),
            'schet' => Yii::t('easyii', 'Schet'),
            'fio' => Yii::t('easyii', 'Fio'),
            'im' => Yii::t('easyii', 'Im'),
            'ot' => Yii::t('easyii', 'Ot'),
            'idcod' => Yii::t('easyii', 'Idcod'),
            'koli_lg' => Yii::t('easyii', 'Koli Lg'),
            'koli_p' => Yii::t('easyii', 'Koli P'),
            'koli_pf' => Yii::t('easyii', 'Koli Pf'),
            'koli_k' => Yii::t('easyii', 'Koli K'),
            'plos_bb' => Yii::t('easyii', 'Plos Bb'),
            'plos_ob' => Yii::t('easyii', 'Plos Ob'),
            'priv' => Yii::t('easyii', 'Priv'),
            'etag' => Yii::t('easyii', 'Etag'),
			'org' => Yii::t('easyii', 'Org'),
			'note' => Yii::t('easyii', 'Note'),
        ];
    }


	public function getFormAttribs() {
		return [
			['class' => '\kartik\grid\SerialColumn'],
			'schet',
			'fio',
			'im',
			'ot',
			'idcod',
						'koli_lg',
					'koli_p',
					'koli_pf',
					'koli_k',
					'plos_bb',
					'plos_ob',
					'priv',
					'etag',
			'org',
			'note',
			[
				'class' => '\kartik\grid\ActionColumn',
				'viewOptions' => ['button' => '<i class="glyphicon glyphicon-eye-open"></i>'],
				'updateOptions' => ['label' => '<i class="glyphicon glyphicon-refresh"></i>'],
				'deleteOptions' => ['label' => '<i class="glyphicon glyphicon-remove"></i>']
			]
		];

	}

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtAbonents()
    {
        return $this->hasMany(UtAbonent::className(), ['id_oldkart' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUtKarts()
    {
        return $this->hasMany(UtKart::className(), ['id_oldkart' => 'id']);
    }
}
