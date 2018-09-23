<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\poslug\models\SearchUtDom */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<?php
$this->title = Yii::t('easyii', 'Ut Doms');
$this->params['breadcrumbs'][] = $this->title;
//$this->params['breadcrumbs'][] = \app\poslug\models\UtUlica::findOne($searchModel->id_ulica)->ul;
?>

<div class="well well-large">
<div class="ut-kart-index">



       <?php  echo $this->render('_search', ['model' => $searchModel]); ?>




    </br>

	<div class="row">
            <?php foreach($doms as $dom) : ?>
                <div class="col-xs-6 col-sm-4 col-md-2 col-xs-offset-1 form-group">
                    <div class="top5">
                    <?= Html::a('<i class="glyphicon glyphicon-home"></i> Буд. '.$dom->n_dom , ['view', 'id' => $dom->id], ['class' => 'btn btn-primary btn-block']) ?>
                    </div>
                </div>
            <?php endforeach;?>
     </div>
 </div>

</div>




