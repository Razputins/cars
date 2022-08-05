<?php

	use app\models\Car;
	use yii\helpers\ArrayHelper;
	use yii\helpers\Html;
	use yii\helpers\Url;
	use yii\grid\ActionColumn;
	use yii\grid\GridView;

	/* @var $this yii\web\View */
	/* @var $searchModel app\models\CarSearch */
	/* @var $dataProvider yii\data\ActiveDataProvider */

	$this->title = 'Cars';
	$this->params['breadcrumbs'][] = $this->title;
?>
	<div class="car-index">

		<h1><?= Html::encode($this->title) ?></h1>

		<p>
			<?= Html::a('Create Car', ['create'], ['class' => 'btn btn-success']) ?>
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
					'attribute' => 'model_id',
					'filter' => ArrayHelper::map(\app\models\Model::find()->all(), 'id', 'name'),
					'filterInputOptions' => ['class' => 'form-control form-control-sm'],
					'value' => function($data) {
						return $data->model->name;
					}
				],
				[
					'attribute' => 'mark_id',
					'filter' => ArrayHelper::map(\app\models\Mark::find()->all(), 'id', 'name'),
					'filterInputOptions' => ['class' => 'form-control form-control-sm'],
					'value' => function($data) {
						return $data->mark->name;
					}
				],
				[
					'class' => ActionColumn::className(),
					'urlCreator' => function ($action, Car $model, $key, $index, $column) {
						return Url::toRoute([$action, 'id' => $model->id]);
					}
				],
			],
		]); ?>


	</div>
<?php
