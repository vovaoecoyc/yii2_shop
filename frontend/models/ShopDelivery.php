<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "shop_delivery".
 *
 * @property string $id
 * @property string $name
 * @property string $type
 * @property string $image
 */
class ShopDelivery extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_delivery';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['name', 'type', 'image'], 'required'],
            ['name', 'required', 'message' => 'Выберите способ доставки'],
            [['name', 'image'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Выберите способ доставки',
            'type' => 'Type',
            'image' => 'Image',
        ];
    }
}
