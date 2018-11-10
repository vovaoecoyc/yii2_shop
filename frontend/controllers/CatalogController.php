<?php

namespace frontend\controllers;

use Yii;
use frontend\models\ShopProducts;
use frontend\models\ShopCategories;
use yii\data\Pagination;

class CatalogController extends \frontend\controllers\ShopController
{

    public function actionIndex()
    {
        $this->setMetaTags('Каталог товаров', Yii::$app->params['defaultKeywords'], Yii::$app->params['defaultDescription']);
        $category_id   = Yii::$app->request->get('section');
        if (!isset($category_id)) {
            $query         = ShopProducts::find()
                              //->asArray();
                            ->with('categories');
            $category_name = 'Все товары каталога';
        }
        else {
            $category      = ShopCategories::findOne(['cat_name_translit' => $category_id]);
            $category_name = $category->name;
            $query         = ShopProducts::find()
//                      ->asArray()
                        ->where(['category_id' => $category->id])
                        ->with('categories');
//                      ->all();
        }
        $pages    = new Pagination([
                        'totalCount'     => $query->count(),
                        'pageSize'       => 6,
                        'forcePageParam' => false, //включает чпу
                        'pageSizeParam'  => false //убирает из параметров url параметр per-page
                    ]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render(
            'index',
            [
                'products'       => $products,
                'category_name'  => $category_name,
                'pages'          => $pages,
                'count'          => $query->count(),
            ]
        );
    }

    public function actionProduct($prod, $cat) {
        //        $product = ShopProducts::findOne(['name_translit' => $prod]);
        $product = ShopProducts::find()
            ->where(['name_translit' => $prod])
            ->with('categories')
            ->limit(1)
            ->one();//если с товаром нужна его категория , т.к. with() рарабоатет только в find()

        $related_products = ShopProducts::find()
            ->andWhere(['category_id' => $product->categories->id])
            ->andWhere(['like', 'name', substr($product->name, 0, 4)])
            ->andWhere(['!=', 'id', $product->id])
            ->limit(10)
            ->all();

        /* запоминаем просмотренные товары */
        Yii::$app->subcomponent->addLatestProduct($product->id);
        /* / */

        if ( Yii::$app->request->isAjax && Yii::$app->request->get('quickView') === 'Y' ) {
            $quickView = Yii::$app->request->get('quickView');
            return $this->renderPartial('product', compact('quickView', 'product') );
        }
        else {
            $this->setMetaTags($product->name, Yii::$app->params['defaultKeywords'], Yii::$app->params['defaultDescription'] . ' ' . $product->name);
            return $this->render(
                'product',
                [
                    'product'          => $product,
                    'related_products' => $related_products
                ]
            );
        }

    }
}
