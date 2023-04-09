<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\UtAbonent $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ut Abonents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ut-abonent-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_org',
            'schet',
            'fio',
            'id_kart',
            'note:ntext',
            'val',
            'del',
            'pass',
            'date_pass',
            'passopen',
            'email:email',
            'telefon',
            'date_entry',
            'vb_api_key',
            'vb_date',
            'vb_org',
            'vb_receiver',
            'vb_name',
            'vb_status',
        ],
    ]) ?>

</div>
