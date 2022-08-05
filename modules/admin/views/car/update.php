<?php

	use yii\helpers\Html;

	/* @var $this yii\web\View */
	/* @var $model app\models\Car */

	$this->title = 'Update Car: ' . $model->name;
	$this->params['breadcrumbs'][] = ['label' => 'Cars', 'url' => ['index']];
	$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
	$this->params['breadcrumbs'][] = 'Update';
?>
<div class="car-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
		'model_list' => $model_list,
		'param_list' => $param_list,
		'car_param' => $car_param,
	]) ?>

</div>
