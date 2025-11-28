<?php

namespace frontend\controllers;

use dvizh\shop\models\Category;
use Yii;
use yii\data\ActiveDataProvider;
use yii\base\Controller;
use yii\web\NotFoundHttpException;
use dvizh\shop\models\Product;

class ProductController extends Controller
{
    public function actionIndex($category = null){
        if(Yii::$app->request->get('category')) $category = Yii::$app->request->get('category');

        $query = \dvizh\shop\models\Product::find()
            ->where(['available' => 'yes'])
            ->orderBy(['id' => SORT_DESC]);

        if($category) $query->andWhere(['category_id' => $category]);

        $products = new ActiveDataProvider([
            'query' => $query, // latest products
            'pagination' => [
                'pageSize' => 9,
            ],
        ]);

        $categories = Category::buildTree();

        return $this->render('index', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    /**
     * Shows a single product page.
     *
     * /product/123
     * /product?slug=iphone-15
     */
    public function actionView($id = null, $slug = null)
    {
        if(Yii::$app->request->get('id')) $id = Yii::$app->request->get('id');

        if(Yii::$app->request->get('slug')) $id = Yii::$app->request->get('slug');

        if ($id !== null) {
            $model = Product::findOne($id);
        } elseif ($slug !== null) {
            $model = Product::find()->where(['slug' => $slug])->one();
        } else {
            throw new NotFoundHttpException('Product not found.');
        }

        if (!$model) {
            throw new NotFoundHttpException('Product not found.');
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }
}
