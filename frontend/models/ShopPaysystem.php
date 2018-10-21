<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "shop_paysystem".
 *
 * @property string $id
 * @property string $name
 * @property string $type
 */
class ShopPaysystem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_paysystem';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['name', 'required', 'message' => 'Выберите способ оплаты'],
            [['name'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Выберите способ оплаты',
            'type' => 'Type',
        ];
    }
}
