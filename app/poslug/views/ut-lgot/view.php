<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtLgot */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Lgots'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-lgot-view">

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
            'period',
            'id_abonent',
            'id_vidlgot',
            'fio',
            'posv_ser',
            'date_n',
            'date_k',
            'kat',
            'flag_vrem',
            'activ',
        ],
    ]) ?>

</div>
