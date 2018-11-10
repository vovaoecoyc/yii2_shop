<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "shop_main_slider".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $image
 */
class ShopMainSlider extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_main_slider';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'image'], 'required'],
            [['description'], 'string'],
            [['title', 'image'], 'string', 'max' => 255],
        ];
    }

}
