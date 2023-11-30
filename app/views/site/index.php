<?php
use yii\bootstrap\Collapse;
use yii\bootstrap\Modal;
use yii\easyii\components\ApiObject;
use yii\easyii\helpers\Image;
use yii\easyii\models\Tag;
	use yii\easyii\models\TagAssign;
	use yii\easyii\modules\article\api\Article;
use yii\easyii\modules\carousel\api\Carousel;
use yii\easyii\modules\gallery\api\Gallery;

use yii\easyii\modules\informing\api\Informing;
use yii\easyii\modules\informing\api\InformingObject;
use yii\easyii\modules\informing\models\Informing as InformingModel;
use yii\easyii\modules\news\api\News;

use yii\easyii\modules\text\api\Text;
use yii\helpers\Html;
	use yii\helpers\Url;

$asset = \app\assets\AppAsset::register($this);
?>




<!-- ======= revolution slider section ======= -->

<!-- ======= /revolution slider section ======= -->


<!-- ======= Welcome section ======= -->
<hr/>

<section class="welcome_sec">
<!--	<div class="container">-->
		<div class="row welcome_heading">
			<div class="col-lg-4 col-md-4 col-sm-12">
				<h2><span itemprop="name"><?= Text::get('index-welcome-title') ?></span></h2>
			</div>
			<div class="carousel col-lg-8 col-md-8 col-sm-9">
				<?= Carousel::widget(800, 420) ?>
			</div>
		</div> <!-- End Row -->
</section>

<hr/>

<?php
//$informing = Informing::last();
$informingmodel = InformingModel::find()->sortDate()->limit(1)->all();

if ($informingmodel!=null) {
//    time
    $day=\yii\easyii\models\Setting::get('visible_informing');

    if ($informingmodel[0]['status']<>0 and date('Y-m-d', strtotime('+'.$day.' days',$informingmodel[0]['time']))>=date('Y-m-d', time())) {
    $informing = new InformingObject($informingmodel[0]);
?>

<section class="our_advisor">
    <div class="container">
        <h2>Оголошення!!!</h2>
    </div>

    </br>

    <div class="row welcome welcome_details">
        <div class="col-lg-12 col-md-12">

            <div class="welcome_item">
                <?php if (!empty($informing->image)) {?>
                         <?=Html::img($informing->thumb(120, 120));?>
                <?php } else {?>
                <?= Html::img(Image::thumb($asset->baseUrl.'/ogoloshennya.jpg',120, 120)); ?>
                <?php } ?>



                <div class="welcome_text">

                    <p><?= $informing->getText(); ?></p>

                </div>
            </div>


        </div>
    </div> <!-- End Row -->

</section>

<hr/>

<?php } } ?>


<section class="our_advisor">
	<div class="container">
		<h2>Інформація по будинках</h2>
</div>

	</br>

	<div class="row welcome welcome_details">
		<div class="col-lg-12 col-md-12">
			<?php
				$article1 = Article::get(51);
					?>
					<div class="welcome_item">
						<?= Html::img($article1->thumb(160, 120)) ?>
						<div class="welcome_info">

							<a href="<?= Url::to(['ut-dom/index']) ?>">

								<p><?= $article1->short ?></p>
							</a>
						</div>
					</div>

		</div>
	</div> <!-- End Row -->

</section>

<hr/>

<section class="our_advisor">
	<div class="container">
	<h2>Послуги</h2>
	</div>

	</br>

		<div class="row welcome welcome_details">
			<div class="col-lg-12 col-md-12">
				<?php

				    $articcat = Article::items(['where' => ['category_id' => '5']]);
					foreach($articcat as $k=>$article)
					{

						?>



						<div class="welcome_item">
							<?= Html::img($article->thumb(160, 120)) ?>
							<div class="welcome_info">
								<h3><?= Html::a($article->title, ['articles/view', 'slug' => $article->slug]) ?></h3>
								<a href="<?= Url::to(['articles/view', 'slug' => $article->slug]) ?>">

									<p><?= $article->short ?></p>
								</a>
							</div>
						</div>
						<?php

					}
				?>
			</div>
		</div> <!-- End Row -->

</section><!-- End welcome_sec
<!-- ======= /Welcome section ======= -->

<hr/>




<section class="career_details">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 pull-right right_side">
				<h2>Новини</h2>
				<div class="tab_option">
					<div class="panel-group tab_option_right" id="accordion">
						<?php

							foreach(News::last(4) as $count=>$news) :
						?>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#<?= $news->slug ?>">
										<span><?php echo Yii::$app->formatter->asDateTime($news->time, "dd") ?></span> <?php echo Yii::$app->formatter->asDateTime($news->time, "php:mm") ?>
										<h5><?= $news->title ?></h5>
										<img src="<?= $asset->baseUrl ?>/images/icon-bg.png" alt="icon" class="active">
										<img src="<?= $asset->baseUrl ?>/images/icon-bg-hover.png" alt="icon" class="hover">
									</a>
								</h4>
							</div>
							<?php
							if ($count==0) :
							?>
								<div id="<?= $news->slug ?>" class="panel-collapse collapse in" >
							<?php
								else:
							?>
								<div id="<?= $news->slug ?>" class="panel-collapse collapse" >
							<?php
								endif
							?>

									<div class="panel-body">
										<?= $news->short ?>
										</br>
										<a href="<?= Url::to(['news/view', 'slug' => $news->slug]) ?>" class="read-more pull-right">Читати <i class="fa fa-angle-right"></i></a>
									</div>
								</div>
						</div>
						<?php endforeach;?>
					</div> <!-- End tab_option_right -->
				</div> <!-- End tab_option -->
			</div> <!-- End right_side -->

			<div class="col-lg-4 col-md-4 col-sm-12 pull-left left_side"> <!-- Left Side -->
				<h4>Популярні новини</h4>
				<?php foreach(News::popular(3) as $news) : ?>
					<ul class="p0 post_item">

						<li><?php echo Yii::$app->formatter->asDate($news->time, 'long') ?>
							</br>
							<a href="<?= Url::to(['news/view', 'slug' => $news->slug]) ?>"><?= $news->title ?></a></li>

					</ul>
				<?php endforeach;?>

			</div> <!-- End left side -->
		</div> <!-- End row -->
	</div> <!-- End container -->
</section> <!-- End career_details -->




<hr/>

<!-- ======== Some Facts ======== -->
<!--<section class="some_facts hidden-xs">-->
<!--	<div class="container">-->
<!--		<span class="timer" data-from="1" data-to="12" data-speed="5000" data-refresh-interval="50">12</span><p>Years of <br>Experiences</p>-->
<!--		<span class="timer" data-from="10" data-to="54" data-speed="5000" data-refresh-interval="50">54</span><p>Professional <br>Advisors</p>-->
<!--		<span class="timer"  data-from="10" data-to="40" data-speed="5000" data-refresh-interval="50">40</span><p>news cases <br>every years</p>-->
<!--		<span class="timer" data-from="10" data-to="89" data-speed="5000" data-refresh-interval="50">89</span><p class="case">Registered <br>Cases</p>-->
<!--	</div>-->
<!--</section> <!-- End some_facts -->
<!-- ======== /Some Facts ======== -->


<section class="our_advisor">
	<div class="container">

			<h2>Фотознімки</h2>

	</div>
	<div class="container-fluid"> <!-- For background-color -->
		<div class="container">
			<div class="row advisor_profile caption-style-3">
				<?php foreach(Gallery::last(4) as $photo) : ?>
				<div class="col-lg-3 col-md-3 col-sm-6 profile">

					<div class="thumbnail">

						<?= $photo->box(280, 235) ?>

<!--						transition: all .9s ease;-->
<!--						-webkit-transform: scale(1.3);-->
<!--						-ms-transform: scale(1.3);-->
<!--						transform: scale(1.3);-->
					</div>

				</div>
				<?php endforeach;?>

			</div> <!-- End row -->
		</div> <!-- End container -->
	</div> <!-- End container-fluid -->
	<?php Gallery::plugin() ?>
</section>





