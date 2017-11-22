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

<!-- =============== blog container ============== -->
<?php
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

<!--<small class="text-muted">Views: --><?//= $article->views?><!--</small>-->