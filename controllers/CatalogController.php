<?php

	namespace app\controllers;

	use app\models\Car;
	use app\models\Mark;
	use app\models\Model;
	use app\models\Param;
	use app\models\ParamCategory;
	use app\models\ParamToCar;
	use Yii;
	use yii\helpers\ArrayHelper;
	use yii\web\Controller;
	use yii\web\NotFoundHttpException;

	class CatalogController extends Controller
	{
		public $page_title = '';
		public $mark_id = '';
		public $model_id = '';
		public $car_ids = [];
		public $params = [];

		public function actionIndex($mark = '', $model = '')
		{
			$get = Yii::$app->request->get();

			$param = $get;

			unset($param['mark']);
			unset($param['model']);

			foreach ($param as $value) {
				$this->params = ArrayHelper::merge($this->params, explode(',', $value));
			}

			if (!empty($mark)) {
				$mark_list = Mark::find()->where(['slug' => $mark])->one();
				if (empty($mark_list)) {
					throw new NotFoundHttpException('Страница не найдена');
				}
				$this->page_title .= $mark_list->name . ' ';
				$this->mark_id = $mark_list->id;
			}

			if (!empty($model)) {
				$model_list = Model::find()->where(['slug' => $model])->one();
				if (empty($model_list)) {
					throw new NotFoundHttpException('Страница не найдена');
				}
				$this->page_title .= $model_list->name . ' ';
				$this->model_id = $model_list->id;
			}



			$cars = Car::getCars($this->mark_id, $this->model_id, $this->params);

			$param_categories = ParamCategory::find()->with('param')->all();
			$mark_list = Mark::find()->with('model')->all();

			$title = "Продажа новых автомобилей {$this->page_title}в Санкт-Петербурге";

			return $this->render('index', [
				'cars' => $cars,
				'title' => $title,
				'param_ids' => $this->params,
				'mark_list' => $mark_list,
				'param_categories' => $param_categories
			]);
		}

		public function actionList()
		{
			$get = Yii::$app->request->get();

			if (empty($get['url'])) {
				return false;
			}

			$url = explode('/', mb_substr($get['url'], 1));

			if (!empty($url[1])) {
				$mark_find = Mark::find()->where(['slug' => $url[1]])->one();
				if (empty($mark_find)) {
					return false;
				}
				$this->mark_id = $mark_find->id;
			}
			if (!empty($url[2])) {
				$model_find = Model::find()->select('id')->where(['slug' => $url[2]])->one();
				if (empty($model_find)) {
					return false;
				}
				$this->model_id = $model_find->id;
			}
			if (!empty($get['ajax_str'])) {
				foreach (explode('&', mb_substr($get['ajax_str'], 1)) as $val) {
					$only_param = explode('=', $val)[1];
					$this->params = ArrayHelper::merge($this->params, explode(',', $only_param));
				}
			}

			$cars = Car::getCars($this->mark_id, $this->model_id, $this->params);

			return $this->renderAjax('ajax/_list', [
				'cars' => $cars,
			]);

		}

	}
