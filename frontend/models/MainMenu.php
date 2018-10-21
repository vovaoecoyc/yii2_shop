<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "main_menu".
 *
 * @property int $ID
 * @property string $NAME
 * @property int $SORT
 */
class MainMenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'main_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NAME', 'SORT'], 'required'],
            [['SORT'], 'integer'],
            [['NAME'], 'string', 'max' => 60],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'NAME' => 'Name',
            'SORT' => 'Sort',
        ];
    }
}
