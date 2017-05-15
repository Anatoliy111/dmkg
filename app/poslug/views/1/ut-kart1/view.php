<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtKart */

$this->title = $model->NAME;
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Karts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-kart-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('easyii', 'Update'), ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('easyii', 'Delete'), ['delete', 'id' => $model->ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('easyii', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID',
            'NAME',
            'fio',
            'IDCOD',
            'id_ulica',
            'DOM',
            'KV',
            'UR_FIZ',
            'PASS',
            'ID_DOM',
            'KOL_KOM',
            'KOL_LUD',
            'PLOS_Z',
            'PLOS_O',
            'ETAG',
            'ID_LGOT',
            'PRIVAT',
            'lift',
            'note:ntext',
            'telef',
            'id_oldkart',
            'id_uslug',
            'id_rabota',
        ],
    ]) ?>

</div>
