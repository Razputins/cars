<?php

	use yii\helpers\Html;

	/* @var $this yii\web\View */
	/* @var $model app\models\Car */

	$this->title = 'Create Car';
	$this->params['breadcrumbs'][] = ['label' => 'Cars', 'url' => ['index']];
	$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-create">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
		'model_list' => $model_list,
		'param_list' => $param_list,
		'car_param' => $car_param,
	]) ?>

</div>
