<?php
use yii\helpers\Html;
$asset = \app\assets\AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<META NAME="Description" CONTENT="ДМКГ КП Долинський міськкомунгосп">
		<META NAME="Keywords" CONTENT="ДМКГ, Долинський, міськкомунгосп, комунальні, послуги, будинки, опалення, водопостачання, dmkg">
		<META NAME="Robots" CONTENT="ALL">
		<META NAME="Revisit-After" CONTENT="10 Days">
		<?= Html::csrfMetaTags() ?>
        <title>ДМКГ</title>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" href="<?= $asset->baseUrl ?>/icon_16.png" type="image/x-icon">
        <link rel="icon" href="<?= $asset->baseUrl ?>/icon_16.png" type="image/x-icon">
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <?= $content ?>
        <?php $this->endBody() ?>
    </body>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-100408931-1', 'auto');
		ga('send', 'pageview');

	</script>
</html>
<?php $this->endPage() ?>