<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "shop_categories".
 *
 * @property string $id
 * @property string $name
 * @property int $depth_level
 */
class ShopCategories extends ActiveRecord
{

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts() {
        return $this->hasMany(ShopProducts::class, ['category_id' => 'id']);
    }

    public function afterFind() {
        if ($this->cat_name_translit === null || $this->cat_name_translit === '') {
            $this->cat_name_translit = strtolower(Yii::$app->subcomponent->transliterate($this->name));
            Yii::$app->db->createCommand()->update(self::tableName(), ['cat_name_translit' => $this->cat_name_translit], "id = $this->id")->execute();
        }
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['depth_level'], 'integer'],
            [['name'], 'string', 'max' => 100],
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
            'parent_section' => 'Parent section',
        ];
    }
}
