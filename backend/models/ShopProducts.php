<?php

namespace backend\models;

use Yii;
//use yii\web\UploadedFile;

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
    public $imageLoad;

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
        return 'shop_products';
    }

    public function getCategory() {
        return $this->hasOne(ShopCategories::class, ['id' => 'category_id']);
    }


    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->name_translit === null || $this->name_translit === '') {
                $this->name_translit = strtolower($this->transliterate($this->name));
            }
            return true;
        }
        return false;
    }

    protected function transliterate($str = '') {
        if ($str != '') {
            return str_replace(Yii::$app->params['rusChars'], Yii::$app->params['enChars'], $str);
        }
        else {
            return '';
        }
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'price', 'currency', 'category_id'], 'required', 'message' => 'Заполните поле'],
            [['description'], 'string'],
            [['price', 'category_id'], 'match', 'pattern' => '/^[0-9\.]+$/', 'message' => 'Неправильный формат цены'],
            [['name'], 'string', 'max' => 150],
            [['name_translit', 'image'], 'string', 'max' => 100],
            [['currency'], 'string', 'max' => 10],
            [['imageLoad'], 'file', 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->removeImage($this->getImage());//удаляем старую главную фотографию (поле isMain в БД)
            $path = Yii::$app->params['pathToFrontendImage'] . $this->imageLoad->baseName . "." . $this->imageLoad->extension;
            $this->imageLoad->saveAs($path);
            $this->attachImage($path, true);
            unlink($path);
            return true;
        } else {
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
            'name_translit' => 'Символьный код',
            'description' => 'Описание',
            'price' => 'Цена',
            'currency' => 'Валюта',
            'category_id' => 'Категория',
            'image' => 'Картинка',
            'imageLoad' => 'Картинка'
        ];
    }
}
