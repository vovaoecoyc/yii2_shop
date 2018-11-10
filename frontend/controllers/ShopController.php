<?php

//namespace app\controllers;
namespace frontend\controllers;

use frontend\models\ShopMainSlider;
use Yii;
use app\models\UserForm;
use app\models\UserSendForms;
use frontend\models\ShopProducts;
use yii\data\Pagination;
use common\models\ShopBrands;

class ShopController extends \yii\web\Controller
{
    //public $layout = 'main';

    /**
     * Main page
     */
    public function actionIndex()
    {
        $slides = ShopMainSlider::find()->all();
        //$menuPoints = Yii::$app->view->params['menuPoints'];
        $this->setMetaTags(Yii::$app->params['defaultTitle'], Yii::$app->params['defaultKeywords'], Yii::$app->params['defaultDescription']);
        $latest_product = Yii::$app->request->cookies->get('latestProduct') ?
                            Yii::$app->subcomponent->cookiesValidationCheck(Yii::$app->request->cookies->get('latestProduct'))
                            : null;
        $brands = ShopBrands::find()->all();
        return $this->render('index', compact('slides', 'latest_product', 'brands'));
    }

    /**
     * Shop page
     */
    public function actionShop()
    {
        return $this->render('shop');
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

    protected function setMetaTags($title = null, $keywords = null, $description = null) {
        if ($title !== null) {
            $this->view->title = $title;
        }
        if ($keywords !== null) {
            $this->view->registerMetaTag([
                'name'    => 'keywords',
                'content' => $keywords
            ]);
        }
        if ($description !== null) {
            $this->view->registerMetaTag([
                'name'    => 'description',
                'content' => $description
            ]);
        }
    }
}
