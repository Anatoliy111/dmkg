<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
	use app\controllers;

	use phpnt\pace\PaceAsset;
	use yii\widgets\Pjax;

	$asset = \app\assets\AppAsset::register($this);

//Html::input('text', null, $search, ['id'=>'search', 'type'=>'text', 'placeholder'=>'Пошук...']);
//Html::button('<span class="icon icon-Search"></span> ', ['type' => 'submit', 'id' => 'button']);



?>



<?php $this->beginContent('@app/views/layouts/base.php');

$search = '';


$my_date = new \DateTime("now", new \DateTimeZone('Europe/Kiev'));
$year = $my_date->format('php:Y');

?>





    <header>

		<?php PaceAsset::register($this);

		error_reporting(E_ALL);
		ini_set("display_errors", 1);

		?>
		<!-- ======= /mainmenu-area section ======= -->
		<section class="search">
			<div class="container-fluid top_head">
				<div class="container">

				</div> <!-- end container -->
			</div><!-- end top_header -->
		</section>



		<section class="bottom_header top-bar-gradient">

				<div class="logo col-lg-3 col-md-12">
					<a href="<?= Url::home() ?>">
						<img itemprop="image" src="<?= $asset->baseUrl ?>/logo.png" alt="ДМКГ">
					</a>
				</div>
				<div class="address col-lg-9 col-md-12">
						<div class="top-info">
							<div class="icon-box">
								<span class=" icon icon-Pointer"></span>
							</div>
							<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress" class="content-box">
								<p itemprop="streetAddress"> вул. Нова 80-А <br> м. Долинська Кіровоградська обл.</p>
							</div>
						</div>
						<div class="top-info">
							<div class="icon-box">
								<span class="separator icon icon-Phone2"></span>
							</div>
							<div class="content-box">
								<p itemprop="telephone"> +38(066)942-00-12 <br> dmkg28500@ukr.net </p>
							</div>
						</div>
						<div class="top-info">
							<div class="icon-box">
								<span class="separator icon icon-Timer"></span>
							</div>
							<div itemprop="openingHoursSpecification" itemscope itemtype="http://schema.org/OpeningHoursSpecification" class="content-box">
								<p itemprop="name">Пн - Пт 8.00 - 17.00 <br/>Сб. Нд. вихідний</p>

							</div>
						</div>


				</div>

		</section> <!-- end bottom_header -->





        <!-- ======= mainmenu-area section ======= -->
		<section class="mainmenu-area">
			<div class="container">
				<nav class="clearfix">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header clearfix">
						<button type="button" class="navbar-toggle collapsed">
							<span class="sr-only">Toggle navigation</span>
							<span class="fa fa-th fa-2x"></span>
						</button>
					</div>
					<div class="nav_main_list custom-scroll-bar pull-left" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav" id="hover_slip">
							<li><a href="<?= Url::home() ?>">Головна</a></li>
							<li><a href='/about/index'>Про нас</a></li>
							<li><a href='/articles/index'>Статті</a></li>
							<li><a href='/news/index'>Новини</a></li>
							<li><a class="contact" href='/gallery/index'>Фотогалерея</a></li>
							<li><a class="contact" href='/contact/index'>Контакти</a></li>
						</ul>
					</div>
					<div class="find-advisor pull-right">
<!--						<a href="--><?//= Url::home() ?><!--ut-kart\index" class="advisor ">Кабінет споживача</a>-->
						<a href='/ut-abonent/index' class="advisor ">Кабінет споживача</a>
					</div>
				</nav> <!-- End Nav -->
			</div> <!-- End Container -->
		</section>
    </header>
    <main class="main">
        <?php if($this->context->id != 'site') : ?>

            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ])?>
        <?php endif; ?>


			<?= $content ?>


        <div class="push"></div>
    </main>


<footer>
	<div class="bottom_footer container-fluid">
		<div class="container">
			<div class="col-lg-3 col-md-3 col-sm-4 col-xs-3 footer-copyright">
				<p>Copyright &copy; DMKG <?=$year?>.</p>
				<p class="float_left">КП "Долинський міськкомунгосп"</p>
			</div>

<!--			<div id="tel-disp" class="float_left">-->
<!--				<p align="center">fghdfhdfgjdfg</p>-->
<!---->
<!--			</div>-->

			<div class="col-lg-3 col-md-3 col-sm-4 col-xs-3 footer-colgroup">
				<div class="footer-info">
					<h3 class="block-title heading">Інформація</h3>
					<span class="toggle-tab mobile" style="display: none;"><span class="hidden">hidden</span></span>
					<div class="block-content block-content-statick toggle-content">
						<ul class="bullet">
							<li><a href='/contact/index'>Контакти</a></li>
<!--							<li><a href='/site/offerta'>Публічний договір-оферта</a></li>-->
							<li><a href='/articles/cat?slug=publicni-dogovori'>Публічні договори</a></li>
						</ul>
					</div>
				</div>
			</div>

			<div class="col-lg-5 col-md-5 col-sm-4 col-xs-12 footer-tel">
				<div class="footer-info">
					<h3 class="block-title heading">Диспетчер (цілодобово)</h3>
					<h4 class="block-title heading">(067) 520-87-30</h4>
					<h4 class="block-title heading">(066) 942-00-12</h4>

				</div>
			</div>



<!--            			<div id="qoo-counter" class="col-lg-1 col-md-1 col-sm-1 col-xs-2 footer-counter">-->
                            <!--LiveInternet counter--><!--<script type="text/javascript">-->
<!--					document.write("<a href='//www.liveinternet.ru/click' "+-->
<!--						"target=_blank><img src='//counter.yadro.ru/hit?t18.6;r"+-->
<!--						escape(document.referrer)+((typeof(screen)=="undefined")?"":-->
<!--						";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?-->
<!--							screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+-->
<!--						";h"+escape(document.title.substring(0,150))+";"+Math.random()+-->
<!--						"' alt='' title='LiveInternet: показано число просмотров за 24"+-->
<!--						" часа, посетителей за 24 часа и за сегодня' "+-->
<!--						"border='0' width='88' height='31'><\/a>")-->
<!--				</script>--><!--/LiveInternet-->

				<img itemprop="image" src="<?= $asset->baseUrl ?>/visa2.png" alt="VISA">

			</div>







		</div>

	</div> <!-- End bottom_footer -->
</footer>
<?php $this->endContent(); ?>
