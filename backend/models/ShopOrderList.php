<?php

namespace backend\models;

use common\models\ShopProducts;
use Yii;

/**
 * This is the model class for table "shop_order_list".
 *
 * @property int $id
 * @property string $prod_name
 * @property int $prod_id
 * @property int $quantity_item
 * @property double $summ_item
 * @property double $price
 * @property int $order_id
 */
class ShopOrderList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_order_list';
    }

    public function getProduct() {
        return $this->hasOne(ShopProducts::class, ['id' => 'prod_id']);
    }

    public function getOrder() {
        return $this->hasOne(ShopOrder::class, ['id' => 'order_id']);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prod_name', 'prod_id', 'quantity_item', 'summ_item', 'price', 'order_id'], 'required'],
            [['prod_id', 'quantity_item', 'order_id'], 'integer'],
            [['summ_item', 'price'], 'number'],
            [['prod_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'prod_name' => 'Prod Name',
            'prod_id' => 'Prod ID',
            'quantity_item' => 'Quantity Item',
            'summ_item' => 'Summ Item',
            'price' => 'Price',
            'order_id' => 'Order ID',
        ];
    }
}
