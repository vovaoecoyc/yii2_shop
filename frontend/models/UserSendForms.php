<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_send_forms".
 *
 * @property string $id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $text
 */
class UserSendForms extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_send_forms';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'phone', 'email', 'text'], 'required'],
            [['phone'], 'integer'],
            [['text'], 'string'],
            [['name', 'email'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'text' => 'Text',
        ];
    }
}
