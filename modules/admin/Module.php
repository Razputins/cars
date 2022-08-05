<?php

	namespace app\modules\admin;

	use Yii;

	/**
	 * event module definition class
	 */
	class Module extends \yii\base\Module
	{
		/**
		 * {@inheritdoc}
		 */
		public $controllerNamespace = 'app\modules\admin\controllers';

		/**
		 * {@inheritdoc}
		 */
		public function init()
		{
			if(Yii::$app->user->isGuest || !Yii::$app->user->identity->isAdmin()){
				return Yii::$app->response->redirect(['/site/login'])->send();
			}

			parent::init();

			// custom initialization code goes here
		}
	}

