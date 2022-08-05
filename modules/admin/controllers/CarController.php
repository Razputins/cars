<?php

	namespace app\modules\admin\controllers;

	use app\models\Car;
	use app\models\CarSearch;
	use app\models\Mark;
	use app\models\Model;
	use app\models\ParamCategory;
	use app\models\ParamToCar;
	use yii\helpers\ArrayHelper;
	use yii\web\Controller;
	use yii\web\NotFoundHttpException;
	use yii\filters\VerbFilter;

	/**
	 * CarController implements the CRUD actions for Car model.
	 */
	class CarController extends Controller
	{
		/**
		 * @inheritDoc
		 */
		public function behaviors()
		{
			return array_merge(
				parent::behaviors(),
				[
					'verbs' => [
						'class' => VerbFilter::className(),
						'actions' => [
							'delete' => ['POST'],
						],
					],
				]
			);
		}

		/**
		 * Lists all Car models.
		 *
		 * @return string
		 */
		public function actionIndex()
		{
			$searchModel = new CarSearch();
			$dataProvider = $searchModel->search($this->request->queryParams);

			return $this->render('index', [
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
			]);
		}

		/**
		 * Displays a single Car model.
		 * @param int $id ID
		 * @return string
		 * @throws NotFoundHttpException if the model cannot be found
		 */
		public function actionView($id)
		{
			return $this->render('view', [
				'model' => $this->findModel($id),
			]);
		}

		/**
		 * Creates a new Car model.
		 * If creation is successful, the browser will be redirected to the 'view' page.
		 * @return string|\yii\web\Response
		 */
		public function actionCreate()
		{
			$model = new Car();

			if ($this->request->isPost) {
				$post = $this->request->post();
				if ($model->load($post)) {
					$mark_id = Model::find()->select(['mark_id'])->where(['id' => $model->model_id])->one()->mark_id;
					$model->mark_id = $mark_id;

					if ($model->save()) {
						if (!empty($post['Car']['param'])) {
							foreach ($post['Car']['param'] as $param) {
								$car_param = new ParamToCar();
								$car_param->car_id = $model->id;
								$car_param->param_id = $param;
								$car_param->save();
							}
						}
						return $this->redirect(['view', 'id' => $model->id]);
					}
				}
			} else {
				$model->loadDefaultValues();
			}

			$model_list = ArrayHelper::map(Model::find()
				->select(['model.id', 'model.name', 'mark.name AS mark'])
				->leftJoin(Mark::tableName(), 'mark.id=model.mark_id')
				->orderBy(['model.name' => SORT_ASC])->asArray()->all(), 'id', 'name', 'mark');

			$param_list = ParamCategory::find()->with('param')->all();

			$car_param = [];

			return $this->render('create', [
				'model' => $model,
				'model_list' => $model_list,
				'param_list' => $param_list,
				'car_param' => $car_param,
			]);
		}

		/**
		 * Updates an existing Car model.
		 * If update is successful, the browser will be redirected to the 'view' page.
		 * @param int $id ID
		 * @return string|\yii\web\Response
		 * @throws NotFoundHttpException if the model cannot be found
		 */
		public function actionUpdate($id)
		{
			$model = $this->findModel($id);

			$post = $this->request->post();
			if ($this->request->isPost && $model->load($post)) {
				$mark_id = Model::find()->select(['mark_id'])->where(['id' => $model->model_id])->one()->mark_id;
				$model->mark_id = $mark_id;
				if($model->save()) {
					if (!empty($post['Car']['param'])) {
						ParamToCar::deleteAll(['car_id' => $model->id]);
						foreach ($post['Car']['param'] as $param) {
							$car_param = new ParamToCar();
							$car_param->car_id = $model->id;
							$car_param->param_id = $param;
							$car_param->save();
						}
					}
					return $this->redirect(['view', 'id' => $model->id]);
				}
			}

			$model_list = ArrayHelper::map(Model::find()
				->select(['model.id', 'model.name', 'mark.name AS mark'])
				->leftJoin(Mark::tableName(), 'mark.id=model.mark_id')
				->orderBy(['model.name' => SORT_ASC])->asArray()->all(), 'id', 'name', 'mark');

			$param_list = ParamCategory::find()->with('param')->all();

			$car_param = ArrayHelper::map(ParamToCar::find()->where(['car_id' => $model->id])->asArray()->all(), 'id', 'param_id');

			return $this->render('update', [
				'model' => $model,
				'model_list' => $model_list,
				'param_list' => $param_list,
				'car_param' => $car_param,
			]);
		}

		/**
		 * Deletes an existing Car model.
		 * If deletion is successful, the browser will be redirected to the 'index' page.
		 * @param int $id ID
		 * @return \yii\web\Response
		 * @throws NotFoundHttpException if the model cannot be found
		 */
		public function actionDelete($id)
		{
			$this->findModel($id)->delete();

			return $this->redirect(['index']);
		}

		/**
		 * Finds the Car model based on its primary key value.
		 * If the model is not found, a 404 HTTP exception will be thrown.
		 * @param int $id ID
		 * @return Car the loaded model
		 * @throws NotFoundHttpException if the model cannot be found
		 */
		protected function findModel($id)
		{
			if (($model = Car::findOne(['id' => $id])) !== null) {
				return $model;
			}

			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
