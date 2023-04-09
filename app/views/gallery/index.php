<?php
use yii\easyii\helpers\Image;
use yii\easyii\modules\gallery\api\Gallery;
use yii\easyii\modules\page\api\Page;
use yii\helpers\Html;
use yii\helpers\Url;

$page = Page::get('page-gallery');

$this->title = $page->seo('title', $page->model->title);
$this->params['breadcrumbs'][] = $page->model->title;
?>


<!-- ======= Latest Work ========= -->
<section class="latest_work latest_work_two">
	<div class="container latest_work_title">
		<h2><?= $page->seo('h1', $page->title) ?></h2>
<!--		<p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi.</p>-->
	</div>
	<div class="work_gallery">
		<div class="container project_row">
			<div class="row">
				<div class="menu_list"> <!-- Menu -->
					<ul class="p0 work_menu">

						<?php foreach(Gallery::cats() as $album) : ?>
						<li class="filter" data-filter=.<?=$album->slug?>><?=$album->title?></li>
						<?php endforeach;?>

					</ul>
				</div>
				<div id="mixitup_list">
					<?php foreach(Gallery::cats() as $album) : ?>
					<?php $photos = Gallery::cat($album->slug)->photos(); ?>
					<?php if(count($photos)) : ?>
						<?php foreach($photos as $photo) : ?>
							<div class="work_img_two mix <?=$album->slug?>">
								<div class="thumbnail">
								<?=$photo->box(369, 282)?>
								</div>
							</div>
						<?php endforeach;?>
						<?php Gallery::plugin(); ?>
						<br/>
					<?php endif; ?>
					<?php endforeach;?>


				</div>

			</div> <!-- End row -->
		</div> <!-- End project_row -->
	</div>
</section> <!-- End latest_work -->
<!-- ======= /Latest Work ========= -->



<br/>





