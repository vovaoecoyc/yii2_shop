<?php

namespace  frontend\components\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Url;
use frontend\models\ShopCategories;

class CatalogMenuWidget extends Widget
{

    public function init() {//часто используется для обработки данных пришедших от пользователя в виджет
        parent::init();

    }

    public function run() {
        $catalogMenuCache = Yii::$app->cache->get('menu-left');
        if ($catalogMenuCache) {
            return $this->render(
                'left-menu',
                [
                    'categories' => $catalogMenuCache
                ]
            );
        }
        /*   изначально здесь( в ShopCategories::find() ) был еще метод asArray(), не используем его из-за того, что метод afterFind()
             работает только с объектом!!! ( в нашем случае преобразовывает название
             нового пункта в транслит )
         */
        $categories = ShopCategories::find()->indexBy('id')->all();
        $categoriesHtml = $this->parseDepthCategories($categories);
        Yii::$app->cache->set('menu-left', $categoriesHtml, 60);
        return $this->render(
            'left-menu',
            [
                'categories' => $categoriesHtml
            ]
        );
    }

    /**
     * Get catalog sections like a tree
     *
     * @param array $tree
     * @param null $section
     * @return string
     */
    protected function parseDepthCategories(array $tree = [], $section = null) {
        if ($section === null) {
            $result    = '';
            $parentIds = [];
            foreach ($tree as $key => $element) {
                $parentIds[] = $element['parent_section'];
            }
            foreach ($tree as $key => $element) {
                if ($element['parent_section'] === '' || $element['parent_section'] === null) {
                    $last = in_array($key, $parentIds) ? '' : 'last';// добавляем класс last жлементу , если он не имеет вложенных секций (позже формируются ссылки для таких элементов)
                    if ($last != '') {
                        $result .= '<h3 data-id="'.$element['id'].'" class="last"><a href="'.Url::to(['catalog/index', 'section' => $element['cat_name_translit']]).'">' . $element['name'] . '</a></h3>';
                    }
                    else {
                        $result .= '<h3 data-id="'.$element['id'].'"><a href="#">' . $element['name'] . '</a></h3>';
                    }
                    $result .= '<div class="section-item">' . self::parseDepthCategories($tree, $key) . '</div>';
                }
            }
        }
        elseif ((int)$section) {
            $childrens = '';
            $parentIds = [];
            foreach ($tree as $key => $element) {
                $parentIds[] = $element['parent_section'];
            }
            foreach ($tree as $key => $element) {
                if ((int)$section === (int)$element['parent_section']) {
                    $last = in_array($key, $parentIds) ? '' : 'last';
                    if ($last != '') {
                        $childrens .= '<h3 data-id="'.$element['id'].'" class="last"><a href="'.Url::to(['catalog/index', 'section' => $element['cat_name_translit']]).'">' .  $element['name'] . '</a></h3>';
                    }
                    else {
                        $childrens .= '<h3 data-id="'.$element['id'].'"><a href="#">' .  $element['name'] . '</a></h3>';
                    }
                    $childrens .= '<div class="section-item">' . self::parseDepthCategories($tree, $key) . '</div>';
                }
            }
            if (!empty($childrens)) {
                return $childrens;
            }
            else {
                return '';
            }
        }
        return $result;
    }

}

?>