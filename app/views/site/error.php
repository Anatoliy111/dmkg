<?php
use yii\helpers\Html;
$this->title = $name;
?>


<!--<div class="alert alert-danger">-->
<!--    --><?//= nl2br(Html::encode($message)) ?>
<!--</div>-->

<!-- ======= Banner ======= -->
<section class="p0 container-fluid banner about_banner">
	<div class="about_banner_opacity">
		<div class="container">
			<div class="banner_info_about">
				<h1>404 Помилка</h1>
				<ul>
<!--					<li><a href="http://ow.ly/XqzNo">Home</a></li>-->
<!--					<li><i class="fa fa-angle-right"></i></li>-->
					<li><?= Html::encode($message) ?></li>
					<br/>
					<li>Сталася помилка під час обробки вашого запиту</li>
				</ul>
			</div> <!-- End Banner Info -->
		</div> <!-- End Container -->
	</div> <!-- End Banner_opacity -->
</section> <!-- End Banner -->
<!-- ================= /Banner ================ -->



