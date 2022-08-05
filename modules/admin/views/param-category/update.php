<?php

	use yii\helpers\Html;

	/* @var $this yii\web\View */
	/* @var $model app\models\ParamCategory */

	$this->title = 'Update Param Category: ' . $model->name;
	$this->params['breadcrumbs'][] = ['label' => 'Param Categories', 'url' => ['index']];
	$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
	$this->params['breadcrumbs'][] = 'Update';
?>
<div class="param-category-update">

	<h1><?= Html::encode($this->title) ?></h1>

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
