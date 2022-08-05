<?php

	namespace app\models;

	use Yii;
	use yii\behaviors\SluggableBehavior;

	/**
	 * This is the model class for table "mark".
	 *
	 * @property int $id
	 * @property string|null $name
	 * @property string $slug
	 */
	class Mark extends \yii\db\ActiveRecord
	{
		/**
		 * {@inheritdoc}
		 */
		public static function tableName()
		{
			return 'mark';
		}

		public function behaviors()
		{
			return [
				[
					'class' => SluggableBehavior::className(),
					'attribute' => ['name'],
					'slugAttribute' => 'slug',
				],
			];
		}

		/**
		 * {@inheritdoc}
		 */
		public function rules()
		{
			return [
				[['name'], 'required'],
				[['name', 'slug'], 'string', 'max' => 255],
			];
		}

		/**
		 * {@inheritdoc}
		 */
		public function attributeLabels()
		{
			return [
				'id' => 'ID',
				'name' => 'Name',
			];
		}

		public function getModel(){
			return $this->hasMany(Model::className(), ['mark_id' => 'id']);
		}
	}
