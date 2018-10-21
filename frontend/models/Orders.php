<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

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
class Orders extends ActiveRecord
{

    /*public $name;
    public $email;
    public $phone;
    public $address;*/

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_orders';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // если вместо метки времени UNIX используется datetime:
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function getOrderList() {
        return $this->hasMany(OrderList::class, ['order_id' => 'id']);
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['user_id', 'created_at', 'updated_at', 'delivery_id', 'paysystem_id', 'quantity', 'summ', 'name', 'email', 'phone', 'address'], 'required'],
            [['user_id', 'delivery_id', 'paysystem_id', 'quantity'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['summ'], 'number'],
            [['status'], 'string'],
            [['name', 'email', 'phone', 'address'], 'string', 'max' => 255],
            [['name', 'email', 'phone', 'address'], 'required', 'message' => 'Заполните поле'],
            ['email', 'email', 'message' => 'Некорректный e-mail адрес'],
            ['phone', 'match', 'pattern' => '/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/', 'message' => 'Некорректный номер телефона'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'ФИО',
            'email' => 'E-mail',
            'phone' => 'Телефон',
            'address' => 'Адрес',
        ];
    }

}
