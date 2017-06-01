<?php

	use yii\bootstrap\Tabs;
	use yii\widgets\Pjax;
	use phpnt\chartJS\ChartJs;


?>

<?php
	$dataPie = [
		'labels' => [
			"Красный",
			"Синий",
			"Желтый"
		],
		'datasets' => [
			[
				'data' => [300, 50, 100],
				'backgroundColor' => [
					"#FF6384",
					"#36A2EB",
					"#FFCE56"
				],
				'hoverBackgroundColor' => [
					"#FF6384",
					"#36A2EB",
					"#FFCE56"
				]
			]
		]
	];

	echo ChartJs::widget([
		'type'  => ChartJs::TYPE_PIE,
		'data'  => $dataPie,
		'options'   => []
	]);

	$dataWeatherOne = [
		'labels' => ["Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь"],
		'datasets' => [
			[
				'data' => [-14, -10, -4, 6, 17, 23, 22, 22, 13, 2, -5, -12],
				'label' =>  "Линейный график (tºC Урал).",
				'fill' => false,
				'lineTension' => 0.1,
				'backgroundColor' => "rgba(75,192,192,0.4)",
				'borderColor' => "rgba(75,192,192,1)",
				'borderCapStyle' => 'butt',
				'borderDash' => [],
				'borderDashOffset' => 0.0,
				'borderJoinStyle' => 'miter',
				'pointBorderColor' => "rgba(75,192,192,1)",
				'pointBackgroundColor' => "#fff",
				'pointBorderWidth' => 1,
				'pointHoverRadius' => 5,
				'pointHoverBackgroundColor' => "rgba(75,192,192,1)",
				'pointHoverBorderColor' => "rgba(220,220,220,1)",
				'pointHoverBorderWidth' => 2,
				'pointRadius' => 1,
				'pointHitRadius' => 10,
				'spanGaps' => false,
			]
		]
	];

	echo ChartJs::widget([
		'type'  => ChartJs::TYPE_BAR,
		'data'  => $dataWeatherOne,
		'options'   => []
	]);
?>


<?php Pjax::begin();?>
<div class="row">
	<div class="col-xs-12 col-md-8">
    <h1> Облік компослуг</h1>




	</div>










</div>
<?php Pjax::end();?>


