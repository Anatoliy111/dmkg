<?php
	/**
	 * Created by PhpStorm.
	 * User: USER
	 * Date: 20.06.2018
	 * Time: 2:58
	 */
	use kartik\grid\GridView; ?>




	<?= GridView::widget([
	'dataProvider' => $dataProvider,
	'columns' => [
		['class' => 'yii\grid\SerialColumn'],

//		'id',
//		'id_org',
//		'period',
//		'id_dom',
//		'id_tarifvid',
		// 'id_naryad',
		 'id_normrab',
		 'ed_izm',
		 'norm_ed',
		 'kol_day',
		 'obiem',
		 'norm_chas',
//		 'notevid',
		 'summa',
		// 'proveden',

		['class' => 'yii\grid\ActionColumn'],
	],
]); ?>