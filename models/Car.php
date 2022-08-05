<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "car".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $model_id
 * @property int|null $mark_id
 */
class Car extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'car';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['model_id', 'mark_id', 'name'], 'required'],
            [['model_id', 'mark_id'], 'default', 'value' => null],
            [['model_id', 'mark_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'model_id' => 'Модель',
            'mark_id' => 'Марка',
        ];
    }

	public function getMark(){
		return $this->hasOne(Mark::className(), ['id' => 'mark_id']);
	}

	public function getModel(){
		return $this->hasOne(Model::className(), ['id' => 'model_id']);
	}
	public function getParam(){
		return $this->hasMany(ParamToCar::className(), ['car_id' => 'id'])->with('param');
	}

	static function getCars($mark_id, $model_id, $params = []){
		$query = self::find();

		if (!empty($mark_id)) {
			$query->where(['mark_id' => $mark_id]);
		}

		if (!empty($model_id)) {
			$query->andWhere(['model_id' => $model_id]);
		}

		if(!empty($params)) {
			$car_ids = Param::find()
				->select(['param_to_car.car_id AS car'])
				->leftJoin('param_to_car', 'param_to_car.param_id=param.id')
				->where(['in', 'param.slug', $params])
				->groupBy('car')
				->asArray()->column();

			if (!empty($car_ids)) {
				$query->andWhere(['in', 'id', $car_ids]);
			}
		}

		return $query->with('param')->all();
	}
}
