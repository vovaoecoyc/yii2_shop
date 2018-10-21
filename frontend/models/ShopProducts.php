<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Command;
/**
 * This is the model class for table "shop_products".
 *
 * @property int $id
 * @property string $name
 * @property string $name_translit
 * @property string $description
 * @property int $price
 * @property int $category_id
 */
class ShopProducts extends ActiveRecord
{

    public function getCategories() {
        return $this->hasOne(ShopCategories::class, ['id' => 'category_id']);
    }

    public function afterFind()
    {
        //$this->price = number_format($this->price, 0, ',', ' ');
        if ($this->name_translit === null || $this->name_translit === '') {
            $this->name_translit = strtolower(Yii::$app->subcomponent->transliterate($this->name));
            //сохраняем транслит названия в БД (посмотреть другой способ, т.к. , кажется , этот не совсем правильный)
            Yii::$app->db->createCommand()->update(self::tableName(), ['name_translit' => $this->name_translit], "id = $this->id")->execute();
        }

        //$this->categories->cat_name_translit = strtolower(Yii::$app->subcomponent->transliterate($this->categories->name));

    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'price', 'category_id'], 'required'],
            [['description'], 'string'],
            [['price', 'category_id'], 'integer'],
            [['name'], 'string', 'max' => 150],
            [['name_translit'], 'string', 'max' => 100],
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
            'name_translit' => 'Name Translit',
            'description' => 'Description',
            'price' => 'Price',
            'category_id' => 'Category ID',
        ];
    }
}
