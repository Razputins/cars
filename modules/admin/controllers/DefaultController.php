<?php

	namespace app\modules\admin\controllers;

	use Yii;
	use yii\web\Controller;

	/**
	 * Default controller for the `recipe` module
	 */
	class DefaultController extends Controller
	{
		public function init()
		{
			parent::init();
		}


		public function actionIndex()
		{
			return $this->render('index');
		}

	}
