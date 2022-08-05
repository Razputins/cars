<?php

namespace app\models;

use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "param".
 *
 * @property int $id
 * @property string|null $name
 * @property string $slug
 * @property int $category_id
 */
class Param extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'param';
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
			[['name', 'category_id'], 'required'],
            [['name'], 'integer'],
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
            'category_id' => 'Категория',
        ];
    }

	public function getCategory(){
		return $this->hasOne(ParamCategory::className(), ['id' => 'category_id']);
	}
}
