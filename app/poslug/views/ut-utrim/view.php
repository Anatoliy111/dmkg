<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtUtrim */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Utrims'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-utrim-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('easyii', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('easyii', 'Delete'), ['delete', 'id' => $model->id], [
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
            'id',
            'id_org',
            'id_abonent',
            'period',
            'id_posl',
            'id_tipposl',
            'id_vidutr',
            'id_rabota',
            'summa',
            'procent',
            'data_n',
            'data_k',
            'zayav',
            'flag_vrem',
            'activ',
        ],
    ]) ?>

</div>
