<?php
use yii\easyii\modules\news\api\News;
use	yii\easyii\modules\news\api\PhotoObject;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\easyii\models\Tag;
use yii\easyii\models\TagAssign;
use yii\easyii\modules\gallery\api\Gallery;

$this->title = $news->seo('title', $news->model->title);
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['news/index']];
//$this->params['breadcrumbs'][] = $news->model->title;

//	$phototitle new class yii\easyii\modules\news\api\PhotoObject;
//	$rr = PhotoObject::className();

?>

<article class="blog-container faqs_sec"> <!-- faqs_sec use for style side content -->
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 pull-right white-right right-side ptb-13">
				<!-- .single-blog-post -->

					<div class="single-blog-post">
						<!-- .img-holder -->
						<!-- .post-meta -->
						<div class="post-meta">
							<div class="date-holder">
								<span><?php echo Yii::$app->formatter->asDateTime($news->time, "dd") ?></span> <?php echo Yii::$app->formatter->asDateTime($news->time, "MMM") ?>
							</div>
							<div class="title-holder">
								<h2 class="title"><?= $news->title ?></h2>
								<ul>
									<li><a>Дата : <?php echo Yii::$app->formatter->asDate($news->time) ?></a></li>
									<li><a>Переглядів : <?= $news->views ?></a></li>
									<li><a>Теги:
											<?php foreach($news->tags as $tag) : ?>
												<?= $tag ?>
											<?php endforeach; ?>
										</a></li>

								</ul>
							</div>
						</div><!-- /.post-meta -->
						<?php if (!empty($news->image)) {?>
							<a href="<?= Url::to([$news->image]) ?>"><?= Html::img($news->thumb(350, 250)) ?></a>
							<?php }?>
						<!-- .content -->
						<div class="content">
							<p><?= $news->text ?></p>
						</div><!-- /.content -->
					</div>

				<?php if(count($news->photos)) : ?>
					<div>
						<div class="container latest_work .latest_work_title">
							<h4>Фотознімки</h4>
						</div>

						<?php foreach($news->photos as $photo) : ?>
							<?= $photo->box(200, 150) ?>
						<?php endforeach;?>
						<?php Gallery::plugin() ?>
					</div>
					<br/>
				<?php endif; ?>
	<!-- .single-blog-post -->

			</div>


			<!-- End right-side -->

			<div class="col-lg-4 col-md-4 col-sm-12 pull-left left_side pbt-86"> <!-- Left Side -->
				<h4>Популярні новини</h4>
				<?php foreach(News::popular(3) as $news) : ?>
					<ul class="p0 post_item">
						<li><?php echo Yii::$app->formatter->asDate($news->time) ?><a href="<?= Url::to(['news/view', 'slug' => $news->slug]) ?>"><?= $news->title ?></a></li>
					</ul>
				<?php endforeach;?>
				<h4>Теги</h4>
				<?php $TagAssign = Tag::findAll(['tag_id' => TagAssign::findAll(['class' => 'yii\easyii\modules\news\models\News'])])  ?>
				<ul class="p0 clouds">
					<?php foreach($TagAssign as $tag) : ?>
						<li><a href="<?= Url::to(['/news', 'tag' => $tag->name]) ?>"><?= $tag->name ?></a></li>
					<?php endforeach; ?>
				</ul>

			</div> <!-- End left side -->
		</div> <!-- End row -->
	</div>
</article>



<!--<div class="small-muted">Views: --><?//= $news->views?><!--</div>-->