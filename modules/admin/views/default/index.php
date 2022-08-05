<?php

	use yii\bootstrap4\Html;

	$this->title = 'Управление';
?>
<div class="site-index">

	<div class="jumbotron text-center bg-transparent">
		<h1 class="display-4">Выберите!</h1>
	</div>

	<div class="body-content">
		<div class="row">
			<div class="col-md-12" style="display: flex; flex-flow: column; align-items: center;">
				<?= Html::a('Машины', ['/admin/car'], ['class' => 'btn btn-primary']); ?>
				<?= Html::a('Марки', ['/admin/mark'], ['class' => 'btn btn-primary']); ?>
				<?= Html::a('Модели', ['/admin/model'], ['class' => 'btn btn-primary']); ?>
				<?= Html::a('Категории параметров', ['/admin/param-category'], ['class' => 'btn btn-primary']); ?>
				<?= Html::a('Параметры', ['/admin/param'], ['class' => 'btn btn-primary']); ?>
			</div>
		</div>
	</div>
</div>
<style>
	.btn-primary{
		width: 300px;
		margin-bottom: 15px;
	}
</style>