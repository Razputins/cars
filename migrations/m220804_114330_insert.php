<?php

	use yii\db\Migration;

	/**
	 * Class m220804_114330_insert
	 */
	class m220804_114330_insert extends Migration
	{
		/**
		 * {@inheritdoc}
		 */
		public function safeUp()
		{
			$this->batchInsert('mark', ['name', 'slug'], [
				['Lexus', 'lexus'],
				['Toyota', 'toyota']
			]);

			$this->batchInsert('model', ['name', 'mark_id', 'slug'], [
				['ES', 1, 'es'],
				['GX', 1, 'gx'],
				['Camry', 2, 'camry'],
				['Corolla', 2, 'corolla'],
			]);

			$this->batchInsert('param_category', ['name', 'slug'], [
				['Тип двигателя', 'engine-type'],
				['Привод', 'privod']
			]);

			$this->batchInsert('param', ['name', 'category_id', 'slug'], [
				['Бензин', 1, 'benzin'],
				['Дизель', 1, 'dizel'],
				['Гибрид', 1, 'gibrid'],
				['Полный', 2, 'polniy'],
				['Передний', 2, 'peredniy' ],
			]);

			$this->batchInsert('car', ['name', 'model_id', 'mark_id'], [
				['Lexus ES', 1, 1],
				['Lexus ES', 1, 1],
				['Lexus ES', 1, 1],
				['Lexus ES', 1, 1],
				['Lexus ES', 1, 1],
				['Lexus GX', 2, 1],
				['Lexus GX', 2, 1],
				['Lexus GX', 2, 1],
				['Lexus GX', 2, 1],
				['Lexus GX', 2, 1],
				['Toyota Camry', 3, 2],
				['Toyota Camry', 3, 2],
				['Toyota Camry', 3, 2],
				['Toyota Camry', 3, 2],
				['Toyota Camry', 3, 2],
				['Toyota Corolla', 4, 2],
				['Toyota Corolla', 4, 2],
				['Toyota Corolla', 4, 2],
				['Toyota Corolla', 4, 2],
				['Toyota Corolla', 4, 2],
			]);

			$this->batchInsert('param_to_car', ['param_id', 'car_id'], [
				[1, 1],
				[4, 1],
				[2, 2],
				[5, 2],
				[3, 3],
				[5, 3],
				[1, 4],
				[4, 4],
				[2, 5],
				[5, 5],
				[3, 6],
				[5, 6],
				[1, 7],
				[4, 7],
				[2, 8],
				[5, 8],
				[3, 9],
				[5, 9],
				[1, 10],
				[4, 10],
				[2, 11],
				[5, 11],
				[3, 12],
				[5, 12],
				[1, 13],
				[4, 13],
				[2, 14],
				[5, 14],
				[3, 15],
				[5, 15],
				[1, 16],
				[4, 16],
				[2, 17],
				[5, 17],
				[3, 18],
				[5, 18],
				[1, 19],
				[4, 19],
				[2, 20],
				[5, 20],
			]);
		}

		/**
		 * {@inheritdoc}
		 */
		public function safeDown()
		{
			$this->truncateTable('car');
			$this->truncateTable('mark');
			$this->truncateTable('model');
			$this->truncateTable('param_category');
			$this->truncateTable('param');
			$this->truncateTable('param_to_car');
		}

		/*
		// Use up()/down() to run migration code without a transaction.
		public function up()
		{

		}

		public function down()
		{
			echo "m220804_114330_insert cannot be reverted.\n";

			return false;
		}
		*/
	}
