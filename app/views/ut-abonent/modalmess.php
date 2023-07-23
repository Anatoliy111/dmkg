<?php


use yii\bootstrap\Modal;
use yii\helpers\Html;

/** @var yii\web\View $this */

  $asset = \app\assets\AppAsset::register($this);

?>


<!--    col-lg-offset-2-->
<?php


Modal::begin([

    'header' => '<h2>'.$modalformheader.'</h2>',
//			'toggleButton' => ['label' => 'click me'],
//			'footer' => 'Низ окна',
    'id' => 'modalmess1',
    'size' => 'modal-md',
    'headerOptions' => [
        'style' => 'text-align: center;'
    ],

]);
?>

<div class="modal-email">

    <img itemprop="image" src="<?= $asset->baseUrl.'/'.$modalformimage ?>" alt="EMAIL">

    <?php
    echo '<h3 style="line-height: 1.5;">'.$modalformtext.'</h3>';
    ?>
</div>


<?php Modal::end(); ?>











