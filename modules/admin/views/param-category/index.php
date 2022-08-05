<?php

	use app\models\ParamCategory;
	use yii\helpers\Html;
	use yii\helpers\Url;
	use yii\grid\ActionColumn;
	use yii\grid\GridView;

	/* @var $this yii\web\View */
	/* @var $searchModel app\models\ParamCategorySearch */
	/* @var $dataProvider yii\data\ActiveDataProvider */

	$this->title = 'Param Categories';
	$this->params['breadcrumbs'][] = $this->title;
?>
<div class="param-category-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a('Create Param Category', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			'id',
			'name',
			[
				'class' => ActionColumn::className(),
				'urlCreator' => function ($action, ParamCategory $model, $key, $index, $column) {
					return Url::toRoute([$action, 'id' => $model->id]);
				}
			],
		],
	]); ?>


</div>
