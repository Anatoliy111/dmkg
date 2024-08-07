<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\poslug\models\UtTipposl */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('easyii', 'Ut Tipposls'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ut-tipposl-view">

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
            'poslug',
            'id_groupposl',
            'old_tipusl',
            'ed_izm',
            'id_vidpokaz',
            'flag_nar',
            'flag_norm',
            'flag_lgot',
            'flag_dom',
            'id_vidpokazprop',
            'del',
        ],
    ]) ?>

</div>
