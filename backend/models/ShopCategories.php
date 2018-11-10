<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "shop_categories".
 *
 * @property string $id
 * @property string $name
 * @property string $cat_name_translit
 * @property int $parent_section
 */
class ShopCategories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_categories';
    }

    public function getCategories() {
        return $this->hasOne(ShopCategories::class, ['id' => 'parent_section']);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent_section'], 'integer'],
            [['name', 'cat_name_translit'], 'string', 'max' => 100],
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
            'cat_name_translit' => 'Символьный код',
            'parent_section' => 'Родительская категория',
        ];
    }
}
