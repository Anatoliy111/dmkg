<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtNarah */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ut Narahs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-narah-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_org',
            'period',
            'id_abonent',
            'id_posl',
            'id_tipposl',
            'tipposl',
            'id_vidlgot',
            'lgot',
            'tarif',
            'id_vidpokaz',
            'vidpokaz',
            'pokaznik',
            'ed_izm',
            'nnorma',
            'sum',
        ],
    ]) ?>

</div>
