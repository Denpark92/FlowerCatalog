<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "flower".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $date_create
 * @property string $date_update
 * @property integer $genus_id
 *
 * @property Genus $genus
 * @property FlowerImage[] $flowerImages
 */
class Flower extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'flower';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'date_create', 'date_update', 'genus_id'], 'required'],
            [['description'], 'string'],
            [['date_create', 'date_update'], 'safe'],
            [['genus_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['genus_id'], 'exist', 'skipOnError' => true, 'targetClass' => Genus::className(), 'targetAttribute' => ['genus_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'description' => 'Описание',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'genus_id' => 'Семейство',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGenus()
    {
        return $this->hasOne(Genus::className(), ['id' => 'genus_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlowerImages()
    {
        return $this->hasMany(FlowerImage::className(), ['flower_id' => 'id']);
    }
}
