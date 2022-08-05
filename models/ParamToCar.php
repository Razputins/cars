<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "param_to_car".
 *
 * @property int $id
 * @property int|null $param_id
 * @property int|null $car_id
 */
class ParamToCar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'param_to_car';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['param_id', 'car_id'], 'default', 'value' => null],
            [['param_id', 'car_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'param_id' => 'Param ID',
            'car_id' => 'Car ID',
        ];
    }

	public function getParam(){
		return $this->hasOne(Param::className(), ['id' => 'param_id']);
	}
}
