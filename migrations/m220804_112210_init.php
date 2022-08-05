<?php

	use yii\db\Migration;

	/**
	 * Class m220804_112210_init
	 */
	class m220804_112210_init extends Migration
	{
		/**
		 * {@inheritdoc}
		 */
		public function safeUp()
		{
			$this->createTable('car', [
				'id' => $this->primaryKey(),
				'name' => $this->string(),
				'model_id' => $this->integer(),
				'mark_id' => $this->integer()
			]);

			$this->createTable('mark', [
				'id' => $this->primaryKey(),
				'name' => $this->string(),
				'slug' => $this->string()
			]);

			$this->createTable('model', [
				'id' => $this->primaryKey(),
				'name' => $this->string(),
				'mark_id' => $this->integer(),
				'slug' => $this->string()
			]);

			$this->createTable('param_category', [
				'id' => $this->primaryKey(),
				'name' => $this->string(),
				'slug' => $this->string()
			]);

			$this->createTable('param', [
				'id' => $this->primaryKey(),
				'name' => $this->string(),
				'category_id' => $this->integer(),
				'slug' => $this->string()
			]);

			$this->createTable('param_to_car', [
				'id' => $this->primaryKey(),
				'param_id' => $this->integer(),
				'car_id' => $this->integer()
			]);
		}

		/**
		 * {@inheritdoc}
		 */
		public function safeDown()
		{
			$this->dropTable('car');
			$this->dropTable('mark');
			$this->dropTable('model');
			$this->dropTable('param_category');
			$this->dropTable('param');
			$this->dropTable('param_to_car');
		}

		/*
		// Use up()/down() to run migration code without a transaction.
		public function up()
		{

		}

		public function down()
		{
			echo "m220804_112210_init cannot be reverted.\n";

			return false;
		}
		*/
	}
