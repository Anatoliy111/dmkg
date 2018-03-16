<?php

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

?>
<span itemscope itemtype="http://schema.org/LocalBusiness"><header>

		<?php PaceAsset::register($this);

		error_reporting(E_ALL);
		ini_set("display_errors", 1);

		?>
		<!-- ======= /mainmenu-area section ======= -->
		<section class="search">
			<div class="container-fluid top_head">
				<div class="container">
<!--					<div  id="search" class="col-xs-6 col-md-4 pull-right">-->
<!--						<script>-->
<!--							(function() {-->
<!--								var cx = '015121369027183181960:uwnbsuww_sq';-->
<!--								var gcse = document.createElement('script');-->
<!--								gcse.type = 'text/javascript';-->
<!--								gcse.async = true;-->
<!--								gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;-->
<!--								var s = document.getElementsByTagName('script')[0];-->
<!--								s.parentNode.insertBefore(gcse, s);-->
<!--							})();-->
<!--						</script>-->
<!--						<gcse:search></gcse:search>-->
<!--					</div>-->
					<!-- <p class="float_left">Welcome to Me Financial Services, we have over 12 years of expertise</p> -->
<!--					<div class="float_right">-->
<!--						<ul>-->
<!--							<li>-->

<!--								<form name="test" method="post" action="/site/search">
<!--								<div  id="search_box">



<!--									<input id="search" type="text" placeholder="Пошук...">-->
<!--        							<button id="button" type="submit"><span class="icon icon-Search"></span></button>-->
<!--								</div>
<!--								</form>-->

<!--							</li>-->
<!--						</ul>-->
<!--					</div>-->
				</div> <!-- end container -->
			</div><!-- end top_header -->
		</section>



		<div class="bottom_header top-bar-gradient">
			<div class="container clear_fix">
				<div class="float_left logo">
					<a href="<?= Url::home() ?>">
						<img itemprop="image" src="<?= $asset->baseUrl ?>/logo.png" alt="ДМКГ">
					</a>
				</div>
				<div class="padding-top">
					<div class="float_left address">
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
								<p itemprop="telephone"> +3805-234-5-22-56 <br> dmkg28500@ukr.net </p>
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
				</div>
			</div> <!-- end container -->
		</div> <!-- end bottom_header -->

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
						<a href='/ut-kart/index' class="advisor ">Кабінет споживача</a>
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
    </main></span>

<footer>
	<div class="bottom_footer container-fluid">
		<div class="container">
			<p class="float_left">Copyright &copy; DMKG 2017. All rights reserved. </p>
<!--			<p class="float_right">Created by: Bondyuk</p>-->
			<div id="qoo-counter">
				<!-- HostCiti.net --><a href="http://hostciti.net/" title="hostciti.net" target="_blank" onclick="this.href='http://hostciti.net/stat/?ch=stat'+'&r='+escape(window.location.href.slice(7));" >
					<script type="text/javascript" language="javascript">
							Coun='<img src="http://hostciti.net/stat/stat.php?i=2&col=4d95bf&tc=ffffff';
						iD=document; Coun+='&d='+(screen.colorDepth?screen.colorDepth:screen.pixelDepth)
							+"&w="+screen.width+'&h='+screen.height;
						iH=window.location.href.slice(7);
						Coun+='&r='+escape(iH);
						Coun+='&n='+escape(iD.referrer.slice(7));
						iD.write(Coun+'" width="88" height="31" border="0" />');
					</script></a><!-- End of HostCiti.net counter -->
			</div>


		</div>

	</div> <!-- End bottom_footer -->
</footer>
<?php $this->endContent(); ?>
