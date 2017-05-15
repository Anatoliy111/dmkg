<?php
use yii\easyii\modules\news\api\News;
use yii\easyii\modules\page\api\Page;
use yii\easyii\models\Tag;
use yii\easyii\models\TagAssign;
use yii\easyii\models;
use yii\helpers\Html;
use yii\helpers\Url;

$page = Page::get('page-news');

$this->title = $page->seo('title', $page->model->title);
$this->params['breadcrumbs'][] = $page->model->title;
?>



<!-- =============== blog container ============== -->
<article class="blog-container faqs_sec"> <!-- faqs_sec use for style side content -->
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 pull-right white-right right-side ptb-13">
				<!-- .single-blog-post -->
				<?php foreach($news as $item) : ?>
				<div class="single-blog-post">
					<!-- .img-holder -->
					<div class="img-holder">
						<?php if (!empty($item->image)) {?>
							<?= Html::img($item->thumb(250, 150)) ?>

<!--						<img src="images/blog/1.jpg" alt="">-->
						<div class="overlay"><a href="<?= Url::to(['news/view', 'slug' => $item->slug]) ?>"></a></div>
						<?php
						}
						?>
					</div><!-- /.img-holder -->
					<!-- .post-meta -->
					<div class="post-meta">
						<div class="date-holder">
							<span><?php echo Yii::$app->formatter->asDateTime($item->time, "dd") ?></span> <?php echo Yii::$app->formatter->asDateTime($item->time, "MMM") ?>
						</div>
						<div class="title-holder">
							<h2 class="title"><?= $item->title ?></h2>
							<ul>
								<li><a>Дата : <?php echo Yii::$app->formatter->asDate($item->time) ?></a></li>
								<li><a>Переглядів : <?= $item->views ?></a></li>
									<li><a>Теги:
										<?php foreach($item->tags as $tag) : ?>
										<?= $tag ?>
										<?php endforeach; ?>
									</a></li>

							</ul>
						</div>
					</div><!-- /.post-meta -->
					<!-- .content -->
					<div class="content">
						<p><?= $item->short ?></p>

						<a href="<?= Url::to(['news/view', 'slug' => $item->slug]) ?>" class="read-more">Читати <i class="fa fa-angle-right"></i></a>
					</div><!-- /.content -->
				</div>
				<!-- .single-blog-post -->
				<?php endforeach; ?>
			</div>


			<!-- End right-side -->

			<div class="col-lg-4 col-md-4 col-sm-12 pull-left left_side pbt-86"> <!-- Left Side -->
				<h4>Популярні новини</h4>
				<?php foreach(News::popular(3) as $news) : ?>
				<ul class="p0 post_item">


					<li><?php echo Yii::$app->formatter->asDate($news->time) ?><a href="<?= Url::to(['news/view', 'slug' => $news->slug]) ?>"><?= $news->title ?></a></li>
<!--					<li>AUG 12,2015<a href="">Making Cents Investments in Start-ups become profitable for Companies ...</a></li>-->
<!--					<li>AUG 12,2015<a href="" class="bottom_item">Making Cents Investments in Start-ups become profitable for Companies ...</a></li>-->
				</ul>
				<?php endforeach;?>
				<h4>Теги</h4>
				<?php $TagAssign = Tag::findAll(['tag_id' => TagAssign::findAll(['class' => 'yii\easyii\modules\news\models\News'])])  ?>
				<ul class="p0 clouds">
					<?php foreach($TagAssign as $tag1) : ?>
						<li><a href="<?= Url::to(['/news', 'tag' => $tag1->name]) ?>"><?= $tag1->name ?></a></li>
					<?php endforeach; ?>
				</ul>

			</div> <!-- End left side -->
		</div> <!-- End row -->
	</div>
</article>


			<li><?= News::pages() ?></li>


<!-- =============== /blog container ============== -->

