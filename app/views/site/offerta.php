<?php
use yii\easyii\modules\feedback\api\Feedback;
use yii\easyii\modules\page\api\Page;



$page = Page::get('page-offerta');

$this->title = $page->seo('title', $page->model->title);
$this->params['breadcrumbs'][] = $page->model->title;
?>

<section class="education_sec">
	<div class="container">
		<div class="col-lg-4 col-md-4 col-sm-12 education_title_holder" style="padding-left: 10px;">
			<h2><?= $page->seo('h1', $page->title) ?></h2>
		</div>
<!--		<div class="col-lg-1 col-md-1 col-sm-2 col-xs-2 education_years_holder">-->
<!--			<span>1993</span>-->
<!--			<span>1997</span>-->
<!--			<span>2002</span>-->
<!--			<span>2005</span>-->
<!--		</div>-->
		<div class="col-lg-7 col-md-7 col-sm-10 col-xs-10">
			<p><?= $page->text ?> <br>
		</div>
	</div>
</section>

