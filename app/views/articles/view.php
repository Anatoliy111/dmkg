<?php
use yii\easyii\modules\article\api\Article;
	use yii\easyii\modules\page\api\Page;
	use yii\easyii\models\Tag;
	use yii\easyii\models\TagAssign;
	use yii\helpers\Html;
	use yii\helpers\Url;

$this->title = $article->seo('title', $article->model->title);
$this->params['breadcrumbs'][] = ['label' => 'Статті', 'url' => ['articles/index']];
$this->params['breadcrumbs'][] = ['label' => $article->cat->title, 'url' => ['articles/cat', 'slug' => $article->cat->slug]];
$this->params['breadcrumbs'][] = $article->model->title;
?>
<!--<h1>--><?//= $article->seo('h1', $article->title) ?><!--</h1>-->

<!-- =============== blog container ============== -->

<article class="blog-container faqs_sec"> <!-- faqs_sec use for style side content -->
	<div class="container">
		<div class="row">

			<div class="col-lg-4 col-md-4 col-sm-12 pull-left left_side pbt-86"> <!-- Left Side -->
				<h4>Категорії </h4>
				<ul class="nav nav-tabs tabs-left"><!-- 'tabs-right' for right tabs -->
<!--					--><?php //foreach(Article::tree() as $node) : ?>
<!--						--><?//= renderNode($node) ?>
<!--					--><?php //endforeach; ?>
				</ul>
				<h4>Популярні статті</h4>
				<?php foreach(article::popular(3) as $articlepop) : ?>
					<ul class="p0 post_item">
						<li><?php echo Yii::$app->formatter->asDate($articlepop->time) ?><a href="<?= Url::to(['articles/view', 'slug' => $articlepop->slug]) ?>"><?= $articlepop->title ?></a></li>
						<!--					<li>AUG 12,2015<a href="">Making Cents Investments in Start-ups become profitable for Companies ...</a></li>-->
						<!--					<li>AUG 12,2015<a href="" class="bottom_item">Making Cents Investments in Start-ups become profitable for Companies ...</a></li>-->
					</ul>
				<?php endforeach;?>
				<h4>Теги</h4>
				<?php $TagAssign = Tag::findAll(['tag_id' => TagAssign::findAll(['class' => 'yii\easyii\modules\article\models\Item'])])  ?>
				<ul class="p0 clouds">
					<?php foreach($TagAssign as $tag1) : ?>
						<li><a href="<?= Url::to(['/articles', 'tag' => $tag1->name]) ?>"><?= $tag1->name ?></a></li>
					<?php endforeach; ?>
				</ul>

			</div> <!-- End left side -->
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 pull-right white-right right-side ptb-13">
				<!-- .single-blog-post -->
							<div class="single-blog-post">
								<!-- .img-holder -->

								<!-- .post-meta -->
								<div class="post-meta">
									<div class="date-holder">
										<span><?php echo Yii::$app->formatter->asDateTime($article->time, "dd") ?></span> <?php echo Yii::$app->formatter->asDateTime($article->time, "MMM") ?>
									</div>
									<div class="title-holder">
										<h2 class="title"><?= $article->title ?></h2>
										<ul>
											<li><a>Дата : <?php echo Yii::$app->formatter->asDate($article->time) ?></a></li>
											<li><a>Переглядів : <?= $article->views ?></a></li>
											<li><a>Теги:
													<?php foreach($article->tags as $tag) : ?>
														<?= $tag ?>
													<?php endforeach; ?>
												</a></li>

										</ul>
									</div>
								</div><!-- /.post-meta -->
								<div class="img-holder">
									<?php if (!empty($article->image))
									{?>
										<?= Html::img($article->thumb(350, 250)) ?>

										<!--						<img src="images/blog/1.jpg" alt="">-->
<!--										<div class="overlay"><a href=""><i class="fa fa-link"></i></a></div>-->
										<?php
									}
									?>
								</div><!-- /.img-holder -->
								<!-- .content -->
								<div class="content">
									<p><?= $article->text ?></p>
								</div><!-- /.content -->
							</div>
				<?php if(count($article->photos)) : ?>
					<div>
						<h4>Фотознімки</h4>
						<?php foreach($article->photos as $photo) : ?>
							<?= $photo->box(100, 100) ?>
						<?php endforeach;?>
						<?php Article::plugin() ?>
					</div>
					<br/>
				<?php endif; ?>
							<!-- .single-blog-post -->
			</div>
		</div> <!-- End row -->
	</div>
</article>

<?php if(count($article->photos)) : ?>
    <div>
        <h4>Photos</h4>
        <?php foreach($article->photos as $photo) : ?>
            <?= $photo->box(100, 100) ?>
        <?php endforeach;?>
        <?php Article::plugin() ?>
    </div>
    <br/>
<?php endif; ?>
<!--<p>-->
<!--    --><?php //foreach($article->tags as $tag) : ?>
<!--        <a href="--><?//= Url::to(['/articles/cat', 'slug' => $article->cat->slug, 'tag' => $tag]) ?><!--" class="label label-info">--><?//= $tag ?><!--</a>-->
<!--    --><?php //endforeach; ?>
<!--</p>-->
<!---->
<!--<small class="text-muted">Views: --><?//= $article->views?><!--</small>-->