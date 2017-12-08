<?php
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\helpers\Html;
	use yii\widgets\Breadcrumbs;
	use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */

$asset = yii\gii\GiiAsset::register($this);
$asset = \app\poslug\assets\AppAsset::register($this);
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
    <div class="container-fluid page-container">
        <?php $this->beginBody() ?>
        <?php
        NavBar::begin([
            'brandLabel' => Html::label('<h4>Компослуги</h4>'),
            'brandUrl' => ['default/index'],
            'options' => ['class' => 'navbar-inverse navbar-fixed-top'],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'nav navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Головна', 'url' => ['default/index']],
				['label' => 'Gii', 'url' => '/gii'],
                ['label' => 'Перейти до сайту', 'url' => Yii::$app->homeUrl],
				['label' => Yii::t('easyii', 'Logout'),['class'=>['glyphicon glyphicon-log-out']],'url' => ['/admin/sign/out']],

		],
        ]);
        NavBar::end();
        ?>
<!--		--><?php //Pjax::begin(); ?>
		<?php
			NavBar::begin([
//				'brandLabel' => Html::img($asset->baseUrl . '/logo.png'),
//				'brandUrl' => ['default/index'],
				'options' => ['class' => 'navbar-default','style'=>'padding-top: 80px'],
			]);
			echo Nav::widget([
				'options' => ['class' => 'nav navbar-nav navbar-left'],
				'items' => [
					[
						'label' => 'Довідники',
						'items' => [
							['label' => 'Картка абонента', 'url' => '/poslug/ut-kart/index'],
							['label' => 'Рахунки', 'url' => '/poslug/ut-abonent/index'],
//							['label' => 'Заявки на авторизацію', 'url' => '/poslug/ut-auth/index'],
//							['label' => 'Вулиці', 'url' => '/poslug/ut-ulica/index'],
							['label' => 'Багатокв. будинки', 'url' => '/poslug/ut-dom/index'],
//							['label' => 'Місце роботи', 'url' => '/poslug/ut-rabota/index'],
//							'<li class="divider"></li>',
//							['label' => 'Види послуг', 'url' => '/poslug/ut-tipposl/index'],
//							['label' => 'Групи послуг', 'url' => '/poslug/ut-groupposl/index'],
//							'<li class="divider"></li>',
//							['label' => 'Тарифи', 'url' => '/poslug/ut-tarif/index'],
//							'<li class="divider"></li>',
//							['label' => 'Види льгот', 'url' => '/poslug/ut-vidlgot/index'],
//							['label' => 'Види утримань', 'url' => '/poslug/ut-vidutrim/index'],
//							['label' => 'Види показників', 'url' => '/poslug/ut-vidpokaz/index'],
//							['label' => 'Од. виміру', 'url' => '/poslug/ut-edizm/index'],
							'<li class="divider"></li>',
//							'<li class="dropdown-header">Dropdown Header</li>',
//							['label' => 'Level 1 - Dropdown B', 'url' => '#'],

						],
					],
					['label' => 'Утримання будинків', 'url' => '/poslug/ut-domzatrat/index'],

//					[
//						'label' => 'Введення даних',
//						'items' => [
//							['label' => 'Показники лічильника', 'url' => '/poslug/ut-lich/index'],
//							['label' => 'Показники складного лічильника', 'url' => '/poslug/ut-lichskl/index'],
//							'<li class="divider"></li>',
//							['label' => 'Льготники', 'url' => '/poslug/ut-lgot/index'],
//							'<li class="divider"></li>',
//							['label' => 'Показники абонентів', 'url' => '/poslug/ut-pokaz/index'],
//							['label' => 'Послуги абонентів', 'url' => '/poslug/ut-posl/index'],
//							['label' => 'Утримання абонентів', 'url' => '/poslug/ut-utrim/index'],
//							['label' => 'Субсидія абонентів', 'url' => '/poslug/ut-subs/index'],
//							['label' => 'Оплата абонентів', 'url' => '/poslug/ut-opl/index'],
//							],
//					],
//					['label' => 'Картка абонента', 'url' => '/poslug/ut-kart/index'],
//					[
//						'label' => 'Розрахунок',
//						'items' => [
//							['label' => 'Нарахування', 'url' => '/poslug/ut-narah/index'],
//							['label' => 'Оборотка', 'url' => '/poslug/ut-obor/index'],
//						],
//					],
					[
						'label' => 'Звіти',
						'items' => [
							['label' => 'Зведена відомість по нарахуванню', 'url' => '/poslug/zvit/zvednarah'],
							['label' => 'Зведена відомість по оборотці', 'url' => '/poslug/zvit/zvedobor'],
							['label' => 'Зведена відомість по оплаті', 'url' => '/poslug/zvit/zvedopl'],
							['label' => 'Зведена відомість по субсидії', 'url' => '/poslug/zvit/zvedsubs'],
						],
					],
					['label' => 'Завантаження', 'url' => '/poslug/default/upload'],
//					['label' => 'Налаштування', 'url' => '/poslug/setting/index'],
				],
			]);
			NavBar::end();
		?>
		<div class="container">
			<?php echo Breadcrumbs::widget([
				'homeLink' => ['label' => 'Головна', 'url' => '/poslug'],
				'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
			]) ?>


            <?= $content ?>


        </div>
<!--		--><?php //Pjax::end(); ?>
        <div class="footer-fix"></div>
    </div>
    <footer class="footer">
        <div class="container">
            <p class="pull-left">A Product of <a href="http://www.yiisoft.com/">Yii Software LLC</a></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<!--		<SCRIPT LANGUAGE="JScript">-->
<!---->
<!--			function ShowFolderList(folderspec)-->
<!--			{-->
<!--				var fso, f, fc, s;-->
<!--				fso = new ActiveXObject("Scripting.FileSystemObject");-->
<!--				f = fso.GetFolder(folderspec);-->
<!--				fc = new Enumerator(f.SubFolders);-->
<!--				s = "";-->
<!--				for (; !fc.atEnd(); fc.moveNext())-->
<!--				{-->
<!--					s += fc.item();-->
<!--					s += "<br>";-->
<!--				}-->
<!--				return(s);-->
<!--			}-->
<!---->
<!--			document.write(ShowFolderList("c:/"));-->
<!---->
<!--		</SCRIPT>-->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
