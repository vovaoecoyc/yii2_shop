<?php

namespace backend\controllers;

use Yii;
use backend\models\ShopProducts;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\ShopCategories;
use yii\web\UploadedFile;

/**
 * ProductsController implements the CRUD actions for ShopProducts model.
 */
class ProductsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ShopProducts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ShopProducts::find()->with('category'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ShopProducts model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ShopProducts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ShopProducts();
        $categories = ShopCategories::find()->asArray()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->imageLoad = UploadedFile::getInstance($model, 'imageLoad');
            if ($model->imageLoad) {
                $model->upload();
            }
            Yii::$app->session->setFlash('createNewProduct', 'Новый товар успешно создан');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'categories' => $categories
        ]);
    }

    /**
     * Updates an existing ShopProducts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $categories = ShopCategories::find()->asArray()->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->imageLoad = UploadedFile::getInstance($model, 'imageLoad');
            if ( $model->imageLoad ) {
                $model->upload();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'categories' => $categories
        ]);
    }

    /**
     * Deletes an existing ShopProducts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();
        $model->removeImage($model->getImage());
        /* удаляем пустую директорию после удаления файла с помощью $model->removeImage($model->getImage()); */
        $modelName = explode('\\',ShopProducts::class);
        $modelName = $modelName[count($modelName) - 1];
        rmdir(Yii::$app->params['pathToFrontendImage'] . $modelName . '/' . $modelName . $id );
        /* / */
        return $this->redirect(['index']);
    }

    /**
     * Finds the ShopProducts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ShopProducts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ShopProducts::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
