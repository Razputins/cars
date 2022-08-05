<?php

	use app\models\Mark;
	use yii\helpers\Html;
	use yii\helpers\Url;
	use yii\grid\ActionColumn;
	use yii\grid\GridView;

	/* @var $this yii\web\View */
	/* @var $searchModel app\models\MarklSearch */
	/* @var $dataProvider yii\data\ActiveDataProvider */

	$this->title = 'Marks';
	$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mark-index">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a('Create Mark', ['create'], ['class' => 'btn btn-success']) ?>
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
				'urlCreator' => function ($action, Mark $model, $key, $index, $column) {
					return Url::toRoute([$action, 'id' => $model->id]);
				}
			],
		],
	]); ?>


</div>
