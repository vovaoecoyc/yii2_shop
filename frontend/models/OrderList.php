<?php

namespace frontend\models;

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
class OrderList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_order_list';
    }

    public function getOrder() {
        return $this->hasOne(Orders::class, ['id' => 'order_id']);
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
     * @param array $cartItems
     * @param $order_id
     */
    public function saveOrderList($cartItems =[], $order_id) {
        if (!($order_id === null)) {
            foreach ($cartItems as $key => $item) {
                $orderList = new self();
                $orderList->prod_name     = $item['name'];
                $orderList->prod_id       = $item['id'];
                $orderList->quantity_item = $item['quantity'];
                $orderList->summ_item     = $item['quantity'] * $item['price'];
                $orderList->price         = $item['price'];
                $orderList->order_id      = $order_id;
                $orderList->save();
                unset($item);
            }
        }
    }

}
