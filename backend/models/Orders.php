<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "shop_orders".
 *
 * @property string $id
 * @property string $user_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $delivery_id
 * @property string $paysystem_id
 * @property int $quantity
 * @property double $summ
 * @property string $status
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $address
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_orders';
    }

    public function getPaySystem() {
        return $this->hasOne(ShopPaysystem::class, ['id' => 'paysystem_id']);
    }

    public function getDelivery() {
        return $this->hasOne(ShopDelivery::class, ['id' => 'delivery_id']);
    }

    public function getOrderList() {
        return $this->hasMany(ShopOrderList::class, ['order_id' => 'id']);
    }

    /* удаляем связанные данные из таблиц shop_orders и shop_order_list */
    public function beforeDelete() {
        parent::beforeDelete();
        foreach ( $this->orderList as $item ) {
            $item->delete();
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'created_at', 'updated_at', 'delivery_id', 'paysystem_id', 'quantity', 'summ', 'name', 'email', 'phone', 'address'], 'required'],
            [['user_id', 'delivery_id', 'paysystem_id', 'quantity'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['summ'], 'number'],
            [['status'], 'string'],
            [['name', 'email', 'phone', 'address'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'ID пользователя',
            'created_at' => 'Дата создания',
            'updated_at' => 'Дата изменения',
            'delivery_id' => 'Способ доставки',
            'paysystem_id' => 'Способ оплаты',
            'quantity' => 'Товаров в заказе',
            'summ' => 'Сумма',
            'status' => 'Статус',
            'name' => 'Имя',
            'email' => 'E-mail',
            'phone' => 'Телефон',
            'address' => 'Адресс',
        ];
    }
}
