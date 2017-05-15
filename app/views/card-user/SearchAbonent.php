<?php
	/**
	 * Created by PhpStorm.
	 * User: USER
	 * Date: 13.03.2017
	 * Time: 1:04
	 */
	use app\models;
	use yii\helpers\Html;
	use yii\grid\GridView;
	use yii\widgets\ListView;
	use yii\data\ActiveDataProvider;




	if (isset($fields))
	{
		foreach($fields as $field)
		{
			echo "<tr>
				<td>{$field['name']}</td>
				<td>{$field['type']}</td>
				<td>{$field['length']}</td>
				<td>{$field['precision']}</td>
				<td>{$field['format']}</td>
				<td>{$field['offset']}</td>
			</tr>";
		}
		echo "</table><br><br>";
	}
?>


