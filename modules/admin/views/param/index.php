<?php

	use app\models\Param;
	use yii\helpers\ArrayHelper;
	use yii\helpers\Html;
	use yii\helpers\Url;
	use yii\grid\ActionColumn;
	use yii\grid\GridView;

	/* @var $this yii\web\View */
	/* @var $searchModel app\models\ParamSearch */
	/* @var $dataProvider yii\data\ActiveDataProvider */

	$this->title = 'Params';
	$this->params['breadcrumbs'][] = $this->title;
?>
<div class="param-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a('Create Param', ['create'], ['class' => 'btn btn-success']) ?>
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
				'attribute' => 'category_id',
				'filter' => ArrayHelper::map(\app\models\ParamCategory::find()->all(), 'id', 'name'),
				'filterInputOptions' => ['class' => 'form-control form-control-sm'],
				'value' => function($data) {
					return $data->category->name;
				}
			],
			[
				'class' => ActionColumn::className(),
				'urlCreator' => function ($action, Param $model, $key, $index, $column) {
					return Url::toRoute([$action, 'id' => $model->id]);
				}
			],
		],
	]); ?>


</div>
