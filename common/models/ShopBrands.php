<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "shop_brands".
 *
 * @property int $id
 * @property string $name
 */
class ShopBrands extends \yii\db\ActiveRecord
{

    public $brandImage;

    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_brands';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['brandImage'], 'file', 'extensions' => 'jpg, png'],
        ];
    }
    /* TODO выделить данный метод в поведение и прикреплять к нужным моделям */
    public function upload() {
        if ($this->validate()) {
            $this->removeImage($this->getImage());
            //$path = '../../frontend/web/img/catalog/' . $this->brandImage->baseName . '.' . $this->brandImage->extension;
            $path = Yii::$app->params['pathToFrontendImage'] . $this->brandImage->baseName . '.' . $this->brandImage->extension;
            $this->brandImage->saveAs($path);
            $this->attachImage($path, true);
            unlink($path);
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'brandImage' => 'Картинка'
        ];
    }
}
