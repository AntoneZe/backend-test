<?php

namespace backend\controllers;

use Yii;
use app\models\Product;
use app\models\ProductTag;
use app\models\Tag;
use app\models\search\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{

    /** @inheritdoc */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'test' => "qwe"
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {

        $product = $this->findModel($id);

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();

        $tags = ArrayHelper::map(Tag::find()->all(), 'id', 'title');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $product = $this->findModel($model->id);

            $tags =  ArrayHelper::getValue(Yii::$app->request->post(), 'Product');
            $parsedTags = ArrayHelper::getValue($tags, 'productTagsIdList');
            $product->saveTags($parsedTags);

            return $this->redirect(['view', 'id' => $model->id]);
        } else {

            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $selectedTags =  $model->getSelectedTags();
        $tags = ArrayHelper::map(Tag::find()->all(), 'id', 'title');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $tags =  ArrayHelper::getValue(Yii::$app->request->post(), 'Product');
            $parsedTags = ArrayHelper::getValue($tags, 'productTagsIdList');
            $model->saveTags($parsedTags);

            return $this->redirect(['view', 'id' => $model->id]);
        } else {

            return $this->render('update', [
                'model' => $model,
                'selectedTags' => $selectedTags,
                'tags' => $tags,
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionSetTags($id)
    {
        $product = $this->findModel($id);
        $selectedTags = $product->getSelectedTags();
        $tags = ArrayHelper::map(Tag::find()->all(), 'id', 'title');

        if (Yii::$app->request->isPost) {
            $tags = Yii::$app->request->post('tags');
            $product->saveTags($tags);

            return $this->redirect(['view', 'id' => $product->id]);
        }

        return $this->render('tags', [
            'product' => $product,
            'selectedTags' => $selectedTags,
            'tags' => $tags,
        ]);
    }
}