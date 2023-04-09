<?php
	/**
	 * Created by PhpStorm.
	 * User: USER
	 * Date: 20.06.2018
	 * Time: 3:00
	 */
	use kartik\grid\GridView;


?>

<?= GridView::widget([
	'dataProvider' => $dataProvider,
	'columns' => [
		['class' => 'yii\grid\SerialColumn'],

		'id',
		'id_naryad',
		'id_normrab',
		'nom_n',
		'naim',
		// 'ed_izm',
		// 'kol',
		// 'cena',
		// 'summa',

		['class' => 'yii\grid\ActionColumn'],
	],
]); ?>
