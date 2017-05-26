<?php
use yii\easyii\modules\article\api\Article;
use yii\easyii\modules\page\api\Page;
	use yii\easyii\models\Tag;
	use yii\easyii\models\TagAssign;
use yii\helpers\Html;
use yii\helpers\Url;



	if (!empty($cat))
	{
		$this->title = $cat->seo('title', $cat->model->title);
		$this->params['breadcrumbs'][] = ['label' => 'Статті', 'url' => ['articles/index']];
		$this->params['breadcrumbs'][] = $cat->model->title;
	}
	else
	{
		$page = Page::get('page-articles');

		$this->title = $page->seo('title', $page->model->title);
		$this->params['breadcrumbs'][] = $page->model->title;
	}




function renderNode($node)
{
    if(!count($node->children)){
		if (Yii::$app->request->get('slug') == $node->slug)
		{
			$html = '<li class="active">'.Html::a($node->title, ['/articles/cat', 'slug' => $node->slug]).'</li>';
		}
		else
		{
			$html = '<li>'.Html::a($node->title, ['/articles/cat', 'slug' => $node->slug]).'</li>';
		}
//        $html = '<li>'.Html::a($node->title, ['/articles/cat', 'slug' => $node->slug]).'</li>';
    } else {
//        $html = '<li class="arrow_down">'.Html::a($node->title).'</li>';
        $html = '</ul>';
//		$html .= '<div class="sub-menu">';
//        foreach($node->children as $child) $html .= renderNode($child);
//		$html .= '</div>';
//        $html .= '</ul>';
    }
    return $html;
}
?>

<!-- =============== blog container ============== -->

<article class="blog-container faqs_sec"> <!-- faqs_sec use for style side content -->
	<div class="container">
		<div class="row">

			<div class="col-lg-4 col-md-4 col-sm-12 pull-left left_side pbt-86"> <!-- Left Side -->
				<h4>Категорії </h4>
				<ul class="nav nav-tabs tabs-left"><!-- 'tabs-right' for right tabs -->
					<?php foreach(Article::tree() as $node) : ?>
						<?= renderNode($node) ?>
					<?php endforeach; ?>
				</ul>
			</div> <!-- End left side -->
			<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 pull-right white-right right-side ptb-13">
				<!-- .single-blog-post -->
				<?php
					if (!empty($cat))
					{
						foreach($items as $item) : ?>

						<div class="single-blog-post">
							<!-- .img-holder -->
							<div class="img-holder">
								<?php if (!empty($item->image))
								{?>
									<?= Html::img($item->thumb(250, 150)) ?>

									<!--						<img src="images/blog/1.jpg" alt="">-->
									<div class="overlay"><a href="<?= Url::to(['articles/view', 'slug' => $item->slug]) ?>"></a></div>
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

								<a href="<?= Url::to(['articles/view', 'slug' => $item->slug]) ?>" class="read-more">Читати <i class="fa fa-angle-right"></i></a>
							</div><!-- /.content -->
						</div>
						<!-- .single-blog-post -->
						<?php endforeach;
					}
 					else
					{
					foreach($article as $item) : ?>

					<div class="single-blog-post">
						<!-- .img-holder -->
						<div class="img-holder">
							<?php if (!empty($item->image))
							{?>
								<?= Html::img($item->thumb(250, 150)) ?>

								<!--						<img src="images/blog/1.jpg" alt="">-->
								<div class="overlay"><a href="<?= Url::to(['articles/view', 'slug' => $item->slug]) ?>"></a></div>
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

							<a href="<?= Url::to(['articles/view', 'slug' => $item->slug]) ?>" class="read-more">Читати <i class="fa fa-angle-right"></i></a>
						</div><!-- /.content -->
					</div>
					<!-- .single-blog-post -->
					<?php endforeach;
					}?>
			</div>
		</div> <!-- End row -->
	</div>
</article>


<li><?= Article::pages() ?></li>

<?php   if (!empty($cat))
	{

	?>
	<?=	$cat->pages();
	}
	?>



