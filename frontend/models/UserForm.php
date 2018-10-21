<?php
/**
 * Created by PhpStorm.
 * User: Hp
 * Date: 10.09.2018
 * Time: 23:28
 */

namespace app\models;

use Yii;
use yii\base\Model;

class UserForm extends Model
{

    public $name;
    public $email;
    public $phone;
    public $text;

    public function attributeLabels() {
        return [
            'name'  => 'Имя',
            'email' => 'E-mail адрес',
            'phone' => 'Телефон',
            'text'  => 'Текст сообщения'
        ];
    }

    public function rules() {
        return [
            [['name', 'email', 'text', 'phone'], 'required', 'message' => 'Заполните поле'],
            ['email', 'email', 'message' => 'Некорректный e-mail адрес'],
            ['phone', 'match', 'pattern' => '/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/', 'message' => 'Некорректный номер телефона'],
            ['phone', 'match', 'pattern' => '/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/', 'message' => 'Некорректный номер телефона'],
        ];
    }
}