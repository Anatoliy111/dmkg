<?php
use yii\easyii\modules\feedback\api\Feedback;
use yii\easyii\modules\page\api\Page;

$page = Page::get('page-contact');

$this->title = $page->seo('title', $page->model->title);
$this->params['breadcrumbs'][] = $page->model->title;
?>
	<section class="history_sec">
		<div class="container">
			<div class="row">
				<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 left-side">
					<h2><?= $page->seo('h1', $page->title) ?></h2>
					<p><?= $page->text ?></p>
<!--					<ul>-->
<!--						<li><a href=""><i class="fa fa-angle-right"></i>&nbsp;&nbsp;Financial Managment and Consulting</a></li>-->
<!--						<li><a href=""><i class="fa fa-angle-right"></i>&nbsp;&nbsp;Advice and Assistance Investing</a></li>-->
<!--						<li><a href=""><i class="fa fa-angle-right"></i>&nbsp;&nbsp;Comprehensive Support for Your Business</a></li>-->
<!--					</ul>-->
				</div>
				<div class="col-lg-5 col-md-5 col-xs-12 col-sm-12 right_side">
					<?php if(Yii::$app->request->get(Feedback::SENT_VAR)) : ?>
						<h4 class="text-success"><i class="glyphicon glyphicon-ok"></i> Повідомлення відправлено</h4>
					<?php else : ?>
						<div class="well well-sm">
							<?= Feedback::form() ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
	<iframe width="100%" height="450" frameborder="1" style="border:0"
			src="https://www.google.com/maps/embed/v1/place?q=48%C2%B006'50.6%22N%2032%C2%B046'51.3%22E&key=AIzaSyDqBeEvnMOOVn57KXo6ovHrsU1Ex21oH2s&maptype=satellite" allowfullscreen>
	</iframe>


