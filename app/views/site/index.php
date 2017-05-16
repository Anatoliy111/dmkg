<?php
use yii\bootstrap\Collapse;
use yii\easyii\models\Tag;
	use yii\easyii\models\TagAssign;
	use yii\easyii\modules\article\api\Article;
use yii\easyii\modules\carousel\api\Carousel;
use yii\easyii\modules\gallery\api\Gallery;

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


			<div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">
				<h2><?= Text::get('index-welcome-title') ?></h2>
			</div>
			<div class="col-sm-8">
				<?= Carousel::widget(800, 420) ?>
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
			<div class="col-lg-6 col-md-12">
				<div class="welcome_item">
					<?php $article = Article::get(4); ?>
					<?= Html::img($article->thumb(160, 120)) ?>
					<div class="welcome_info">
						<h3><?= Html::a($article->title, ['articles/view', 'slug' => $article->slug]) ?></h3>
						<a href="<?= Url::to(['articles/view', 'slug' => $article->slug]) ?>">

						<p><?= $article->short ?></p>
						</a>
					</div>
				</div>
				<div class="welcome_item welcome_item_bottom">
					<?php $article = Article::get(5); ?>
					<?= Html::img($article->thumb(160, 120)) ?>
					<div class="welcome_info">
						<h3><?= Html::a($article->title, ['articles/view', 'slug' => $article->slug]) ?></h3>
						<a href="<?= Url::to(['articles/view', 'slug' => $article->slug]) ?>">
						<p><?= $article->short ?></p>
						</a>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-12 bottom_row">
				<div class="welcome_item">
					<?php $article = Article::get(6); ?>
					<?= Html::img($article->thumb(160, 120)) ?>
					<div class="welcome_info">
						<h3><?= Html::a($article->title, ['articles/view', 'slug' => $article->slug]) ?></h3>
						<a href="<?= Url::to(['articles/view', 'slug' => $article->slug]) ?>">
							<p><?= $article->short ?></p>
						</a>
					</div>
				</div>
				<div class="welcome_item welcome_item_bottom">
					<?php $article = Article::get(7); ?>
					<?= Html::img($article->thumb(160, 120)) ?>
					<div class="welcome_info">
						<h3><?= Html::a($article->title, ['articles/view', 'slug' => $article->slug]) ?></h3>
						<a href="<?= Url::to(['articles/view', 'slug' => $article->slug]) ?>">
							<p><?= $article->short ?></p>
						</a>
					</div>
				</div>
			</div>
		</div> <!-- End Row -->
<!--	</div> <!-- End container -->
</section><!-- End welcome_sec
<!-- ======= /Welcome section ======= -->



<!--<br/>-->
<hr/>

<section class="row our_advisor">
	<div class="container">
		<h2>Новини</h2>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-12 pull-left left_side pbt-86"> <!-- Left Side -->
		<h4>Популярні новини</h4>
		<?php foreach(News::popular(3) as $news) : ?>
			<ul class="p0 post_item">


				<li><?php echo Yii::$app->formatter->asDate($news->time) ?><a href="<?= Url::to(['news/view', 'slug' => $news->slug]) ?>"><?= $news->title ?></a></li>
			</ul>
		<?php endforeach;?>

	</div> <!-- End left side -->

	<div class="col-lg-6 col-md-6 news">
		<?php
		$items = [];
		foreach(News::last(4) as $news) :



					array_push($items,


						[
							'label' => $news->title,
							'content' => $news->short,
						]


					);









		endforeach;?>

		<!--				<div class="news_details">-->

<!--		<a href="--><?//= Url::to(['news/view', 'slug' => $news->slug]) ?><!--">-->
<!--			<span>--><?php //echo Yii::$app->formatter->asDate($news->time) ?><!--</span>-->
<!--			<h4>--><?//= $news->title ?><!--</h4>-->
<!--			<p>--><?//= $news->short ?><!-- </p>-->
<!--		</a>-->
	<?php	echo Collapse::widget([
		'items' => $items,
		]);
	?>
<!--	--><?php //foreach(News::last(4) as $news) : ?>
<!---->
<!---->
<!--<!--				<div class="news_details">-->-->
<!--					<a href="--><?//= Url::to(['news/view', 'slug' => $news->slug]) ?><!--">-->
<!--						<span>--><?php //echo Yii::$app->formatter->asDate($news->time) ?><!--</span>-->
<!--						<h4>--><?//= $news->title ?><!--</h4>-->
<!--						<p>--><?//= $news->short ?><!-- </p>-->
<!--					</a>-->
<!--<!--				</div>-->-->
<!---->
<!---->
<!--	--><?php //endforeach;?>
	</div>

</section>

<!-- ======== Latest News ======== -->
<!--<section class="p0 container-fluid latest_news_sec news_large">-->
<!--	<div class="container">-->
<!--		<h2>Новини</h2>-->
<!--	</div>-->
<!--	<div class="news_highlight">-->
<!--		--><?php //foreach(News::last(4) as $news) : ?>
<!--		<div class="col-lg-3 col-md-6 news">-->
<!--			<div class="news_img_holder">-->
<!--				--><?php //if (!empty($news->image)) {?>
<!--					--><?//= Html::img($news->thumb(300, 300)) ?>
<!--				--><?php //}
//					else{ ?>
<!--						<img src="--><?//= $asset->baseUrl ?><!--/News--300x239.jpeg" style="width: 300px; height: 300px">-->
<!--					--><?php //	}	?>
<!--				<div class="news_opacity">-->
<!--				</div>-->
<!--				<div class="news_details">-->
<!--					<a href="--><?//= Url::to(['news/view', 'slug' => $news->slug]) ?><!--">-->
<!--						<span>--><?php //echo Yii::$app->formatter->asDate($news->time) ?><!--</span>-->
<!--						<h4>--><?//= $news->title ?><!--</h4>-->
<!--						<p>--><?//= $news->short ?><!-- </p>-->
<!--					</a>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--		--><?php //endforeach;?>
<!--	</div>-->
<!--</section> <!-- End latest_news_sec -->-->
<!-- ======== /Latest News ======== -->


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




<br/>
