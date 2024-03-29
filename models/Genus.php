<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "genus".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Flower[] $flowers
 */
class Genus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'genus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlowers()
    {
        return $this->hasMany(Flower::className(), ['genus_id' => 'id']);
    }
}
