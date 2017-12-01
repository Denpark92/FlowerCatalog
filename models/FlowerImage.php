<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "flower_image".
 *
 * @property integer $id
 * @property string $path
 * @property integer $main_image
 * @property integer $flower_id
 *
 * @property Flower $flower
 */
class FlowerImage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'flower_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['main_image', 'flower_id'], 'integer'],
            [['path'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 0],
            [['flower_id'], 'exist', 'skipOnError' => true, 'targetClass' => Flower::className(), 'targetAttribute' => ['flower_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'path' => 'Изображение',
            'main_image' => 'Main Image',
            'flower_id' => 'Flower ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlower()
    {
        return $this->hasOne(Flower::className(), ['id' => 'flower_id']);
    }
}
