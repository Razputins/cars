<?php

	use app\models\Model as ModelCar;
	use yii\helpers\ArrayHelper;
	use yii\helpers\Html;
	use yii\helpers\Url;
	use yii\grid\ActionColumn;
	use yii\grid\GridView;

	/* @var $this yii\web\View */
	/* @var $searchModel app\models\ModelSearch */
	/* @var $dataProvider yii\data\ActiveDataProvider */

	$this->title = 'Models';
	$this->params['breadcrumbs'][] = $this->title;
?>
<div class="model-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a('Create Model', ['create'], ['class' => 'btn btn-success']) ?>
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
				'attribute' => 'mark_id',
				'filter' => ArrayHelper::map(\app\models\Mark::find()->all(), 'id', 'name'),
				'filterInputOptions' => ['class' => 'form-control form-control-sm'],
				'value' => function($data) {
					return $data->mark->name;
				}
			],
			[
				'class' => ActionColumn::className(),
				'urlCreator' => function ($action, ModelCar $model, $key, $index, $column) {
					return Url::toRoute([$action, 'id' => $model->id]);
				}
			],
		],
	]); ?>


</div>
