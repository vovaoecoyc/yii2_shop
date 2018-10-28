<?php

namespace common\models;

use frontend\models\ShopCategories;
use Yii;

/**
 * This is the model class for table "shop_products".
 *
 * @property int $id
 * @property string $name
 * @property string $name_translit
 * @property string $description
 * @property int $price
 * @property string $currency
 * @property int $category_id
 * @property string $image
 */
class ShopProducts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_products';
    }

    public function getOrderList() {
        return $this->hasMany(ShopOrderList::class, ['prod_id' => 'id']);
    }

    public function getCategories() {
        return $this->hasOne(ShopCategories::class, ['id' => 'category_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'price', 'currency', 'category_id', 'image'], 'required'],
            [['description'], 'string'],
            [['price', 'category_id'], 'integer'],
            [['name'], 'string', 'max' => 150],
            [['name_translit', 'image'], 'string', 'max' => 100],
            [['currency'], 'string', 'max' => 10],
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
            'name_translit' => 'Name Translit',
            'description' => 'Description',
            'price' => 'Price',
            'currency' => 'Currency',
            'category_id' => 'Category ID',
            'image' => 'Image',
        ];
    }
}
