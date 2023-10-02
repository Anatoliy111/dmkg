<?php
use app\poslug\models\UtPeriod;
use kartik\nav\NavX;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\helpers\Html;
	use yii\widgets\Breadcrumbs;
use yii\helpers\Url;


/* @var $this \yii\web\View */
/* @var $content string */

//$asset = yii\gii\GiiAsset::register($this);
$asset = \app\poslug\assets\AppAsset::register($this);
$period =date('Y-m-d', strtotime(UtPeriod::find()->select('period')->orderBy(['period' => SORT_DESC])->one()->period.' +1 month'));
//	C:\OpenServer\domains\DMKGtest\vendor\bower\eonasdan-bootstrap-datetimepicker\build\js\bootstrap-datetimepicker.min.js
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>


<body>

<div class="preloader">
    <div class="preloader__row">
        <div class="preloader__item"></div>
        <div class="preloader__item"></div>
    </div>
    <div class="preloader__row2">
        <div class="preloader__item2"></div>
        <div class="preloader__item2"></div>
    </div>
</div>




    <div class="container-fluid page-container">
        <?php $this->beginBody() ?>


        <div class="menu-main">

            <?php
            echo NavX::widget([
                'options'=>['class'=>'nav nav-pills'],
                'items' => [
                    ['label' => 'Головна', 'url' => ['default/index']],
                    ['label' => 'Gii', 'url' => '/gii'],
                    ['label' => 'Перейти до сайту', 'url' => Yii::$app->homeUrl],
                    ['label' => Yii::t('easyii', 'Logout'),['class'=>['glyphicon glyphicon-log-out']],'url' => ['/admin/sign/out']],
                ],
            ]);



            NavBar::begin();
            echo NavX::widget([
                'options' => ['class' => 'navbar-nav','data-pjax' => 1],
                'activateParents' => true,
                'encodeLabels' => false,
            ]);
            NavBar::end();
            ?>

        </div>



<!--        --><?php
//        NavBar::begin([
//            'brandLabel' => Html::label('<h4>Компослуги</h4>'),
//            'brandUrl' => ['default/index'],
//            'options' => ['class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',],
//        ]);
//        echo Nav::widget([
//            'options' => ['class' => 'nav navbar-nav navbar-right'],
//            'items' => [
//                ['label' => 'Головна', 'url' => ['default/index']],
//				['label' => 'Gii', 'url' => '/gii'],
//                ['label' => 'Перейти до сайту', 'url' => Yii::$app->homeUrl],
//				['label' => Yii::t('easyii', 'Logout'),['class'=>['glyphicon glyphicon-log-out']],'url' => ['/admin/sign/out']],
//
//		],
//        ]);
//        NavBar::end();
//        ?>




		<?php


			NavBar::begin([
//				'brandLabel' => Html::img($asset->baseUrl . '/logo.png'),
//				'brandUrl' => ['default/index'],
				'options' => ['class' => 'navbar navbar-expand-md'],
			]);
			?>

		<div class="col-xs-12">
			<div class="col-xs-6 pull-left">
				<h3>Поточний період <?=Yii::$app->formatter->asDate($period, 'LLLL Y')?></h3>
			</div>
		</div>




<!--			--><?php
//
//
//
//
//
//			echo Nav::widget([
//				'options' => ['class' => 'nav navbar-nav navbar-left'],
//				'items' => [
//                    ['label' => 'Картка абонента', 'url' => '/poslug/default/KartAbon'],
////                    ['label' => 'Оборотна відомість по послугам ', 'url' => '/poslug/default/Obor'],
//                    ['label' => 'Вивіз сміття ПС', 'url' => ['default/smitpc']],
//
//
//
//					[
//						'label' => 'Абоненти',
//						'items' => [
//							['label' => 'Картка абонента', 'url' => '/poslug/ut-kart/index'],
//							['label' => 'Рахунки', 'url' => '/poslug/ut-abonent/index'],
//
////							['label' => 'Місце роботи', 'url' => '/poslug/ut-rabota/index'],
////							'<li class="divider"></li>',
////							['label' => 'Види послуг', 'url' => '/poslug/ut-tipposl/index'],
////							['label' => 'Групи послуг', 'url' => '/poslug/ut-groupposl/index'],
////							'<li class="divider"></li>',
////							['label' => 'Тарифи', 'url' => '/poslug/ut-tarif/index'],
////							'<li class="divider"></li>',
////							['label' => 'Види льгот', 'url' => '/poslug/ut-vidlgot/index'],
////							['label' => 'Види утримань', 'url' => '/poslug/ut-vidutrim/index'],
////							['label' => 'Види показників', 'url' => '/poslug/ut-vidpokaz/index'],
////
//							'<li class="divider"></li>',
////							'<li class="dropdown-header">Dropdown Header</li>',
////							['label' => 'Level 1 - Dropdown B', 'url' => '#'],
//
//						],
//					],
//					[
//						'label' => 'Побудинковий облік',
//						'items' => [
//							['label' => 'Будинки', 'url' => '/poslug/ut-dom/index'],
//							['label' => 'Планові тарифи', 'url' => '/poslug/ut-tarifplan/index'],
//							['label' => 'Наряд-завдання', 'url' => '/poslug/ut-domnaryad/index'],
//							['label' => 'Роботи без наряду', 'url' => '/poslug/ut-domrab/index'],
//							['label' => 'Списання матеріалів без наряду', 'url' => '/poslug/ut-dommat/index'],
//							['label' => 'Роботи постачальників', 'url' => '/poslug/ut-domakt/index'],
//							],
//					],
//
//					[
//						'label' => 'Довідники',
//						'items' => [
//							['label' => 'Види розшифровки тарифів', 'url' => '/poslug/ut-tarifvid/index'],
//							['label' => 'Од. виміру', 'url' => '/poslug/ut-edizm/index'],
//							['label' => 'Норми робочого часу', 'url' => '/poslug/ut-normrab/index'],
//							['label' => 'Опис робіт по видам тарифу', 'url' => '/poslug/ut-notevid/index'],
//							['label' => 'Постачальники', 'url' => '/poslug/ut-postach/index'],
//							['label' => 'Співробітники', 'url' => '/poslug/ut-sotr/index'],
//							['label' => 'Матеріали', 'url' => '/poslug/ut-mat/index'],
//							['label' => 'Вул', 'url' => '/poslug/ut-ulica/index'],
//						],
//					],
//
////					[
////						'label' => 'Введення даних',
////						'items' => [
////							['label' => 'Показники лічильника', 'url' => '/poslug/ut-lich/index'],
////							['label' => 'Показники складного лічильника', 'url' => '/poslug/ut-lichskl/index'],
////							'<li class="divider"></li>',
////							['label' => 'Льготники', 'url' => '/poslug/ut-lgot/index'],
////							'<li class="divider"></li>',
////							['label' => 'Показники абонентів', 'url' => '/poslug/ut-pokaz/index'],
////							['label' => 'Послуги абонентів', 'url' => '/poslug/ut-posl/index'],
////							['label' => 'Утримання абонентів', 'url' => '/poslug/ut-utrim/index'],
////							['label' => 'Субсидія абонентів', 'url' => '/poslug/ut-subs/index'],
////							['label' => 'Оплата абонентів', 'url' => '/poslug/ut-opl/index'],
////							],
////					],
////					['label' => 'Картка абонента', 'url' => '/poslug/ut-kart/index'],
////					[
////						'label' => 'Розрахунок',
////						'items' => [
////							['label' => 'Нарахування', 'url' => '/poslug/ut-narah/index'],
////							['label' => 'Оборотка', 'url' => '/poslug/ut-obor/index'],
////						],
////					],
//					[
//						'label' => 'Звіти',
//						'items' => [
//							['label' => 'Зведена відомість по нарахуванню', 'url' => '/poslug/zvit/zvednarah'],
//							['label' => 'Зведена відомість по оборотці', 'url' => '/poslug/zvit/zvedobor'],
//							['label' => 'Зведена відомість по оплаті', 'url' => '/poslug/zvit/zvedopl'],
//							['label' => 'Зведена відомість по субсидії', 'url' => '/poslug/zvit/zvedsubs'],
//						],
//					],
//					[
//						'label' => 'Адміністрування',
//						'items' => [
//							['label' => 'Завантаження', 'url' => '/poslug/default/upload'],
//							],
//					],
//				],
//			]);
//			NavBar::end();
//		?>

        </div>



		<div class="container">



            <div class="menu-poslug">

            <?php
            echo NavX::widget([
                'options'=>['class'=>'nav nav-pills'],
                'items' => [
                    ['label' => 'Картка абонента', 'url' => 'index'],
//                    ['label' => 'Оборотна відомість по послугам ', 'url' => '/poslug/default/Obor'],
                    ['label' => 'Вивіз сміття', 'url' => ['default/smitpc']],
                ],
            ]);



            NavBar::begin();
            echo NavX::widget([
                'options' => ['class' => 'navbar-nav','data-pjax' => 1],
                'activateParents' => true,
                'encodeLabels' => false,
            ]);
            NavBar::end();
            ?>

            </div>



			<?php echo Breadcrumbs::widget([
				'homeLink' => ['label' => 'Головна', 'url' => '/poslug'],
				'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
			]) ?>




            <?= $content ?>


       </div>

        <div class="footer-fix"></div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">A Product of <a href="http://www.yiisoft.com/">Yii Software LLC</a></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>




<?php $this->endBody() ?>


</body>
</html>
<?php $this->endPage() ?>
