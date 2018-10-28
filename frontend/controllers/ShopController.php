<?php

//namespace app\controllers;
namespace frontend\controllers;

use Yii;
use app\models\UserForm;
use app\models\UserSendForms;
use frontend\models\ShopProducts;
use yii\data\Pagination;

class ShopController extends \yii\web\Controller
{
    //public $layout = 'main';

    /**
     * Main page
     */
    public function actionIndex()
    {
        //$menuPoints = Yii::$app->view->params['menuPoints'];
        return $this->render('index');
    }

    /**
     * Shop page
     */
    public function actionShop()
    {
        return $this->render('shop');
    }

    /**
     * Cart page
     */
    public function actionCart()
    {
        return $this->render('cart');
    }

    /**
     * CheckOut page
     */
    public function actionCheckout()
    {
        return $this->render('checkout');
    }

    /**
     * Single-product page
     */
    public function actionSingleProduct()
    {
        return $this->render('single-product');
    }

    /**
     * Contact page
     */
    public function actionContacts() {
        $model = new UserForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $contactData = new UserSendForms();
            $contactData->name  = $model->name;
            $contactData->email = $model->email;
            $contactData->phone = $model->phone;
            $contactData->text  = $model->text;
            $contactData->save();

            return $this->render(
            'contacts',
                [
                    'model'   => $model,
                    'success' => true,
                    'errors'  => false
                ]
            );
        }
        else {
            return $this->render(
            'contacts',
                [
                    'model'   => $model,
                    'success' => false,
                    'errors'  => true
                ]
            );
        }
    }

    public function actionSearch() {

//        $search_products = [];
        $q = trim(htmlspecialchars(strip_tags(Yii::$app->request->get('q'))));
        $query = ShopProducts::find()
            ->orWhere(['like', 'name', $q.' '])
            ->orWhere(['like', 'name', ' '.$q.' '])
            ->orWhere(['like', 'name', ' '.$q]);
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize'   => 6,
            'forcePageParam' => false, //включает чпу
            'pageSizeParam'  => false //убирает из параметров url параметр per-page
        ]);
        $search_products = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render(
            'search',
            [
                'search_request'  => $q,
                'pages'           => $pages,
                'search_products' => $search_products
            ]
        );
    }
}
