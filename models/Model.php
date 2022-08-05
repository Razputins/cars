<?php

namespace app\models;

use Yii;
use yii\behaviors\SluggableBehavior;

/**
 * This is the model class for table "model".
 *
 * @property int $id
 * @property string|null $name
 * @property string $slug
 * @property int|null $mark_id
 */
class Model extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'model';
    }

	public function behaviors()
	{
		return [
			[
				'class' => SluggableBehavior::className(),
				'attribute' => ['name'],
				'slugAttribute' => 'slug',
				'ensureUnique' => true,
				'immutable' => true,
				'skipOnEmpty' => false,
			],
		];
	}
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
			[['name', 'mark_id'], 'required'],
            [['mark_id'], 'default', 'value' => null],
            [['mark_id'], 'integer'],
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
            'name' => 'Название',
            'mark_id' => 'Марка',
        ];
    }

	public function getMark(){
		return $this->hasOne(Mark::className(), ['id' => 'mark_id']);
	}
}
