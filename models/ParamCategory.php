<?php

namespace app\models;

use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "param_category".
 *
 * @property int $id
 * @property string|null $name
 * @property string $slug
 */
class ParamCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'param_category';
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
            'name' => 'Name',
        ];
    }

	public function getParam(){
		return $this->hasMany(Param::className(), ['category_id' => 'id']);
	}
}
