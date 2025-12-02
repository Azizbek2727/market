<?php

namespace backend\controllers;

use common\models\dvizh\Product;
use dvizh\shop\events\ProductEvent;
use dvizh\shop\models\Modification;
use dvizh\shop\models\modification\ModificationSearch;
use dvizh\shop\models\Price;
use dvizh\shop\models\price\PriceSearch;
use dvizh\shop\models\PriceType;
use Yii;
use yii\web\NotFoundHttpException;

class ProductController extends \dvizh\shop\controllers\ProductController
{
    public function actionUpdate($id)
    {
        $priceModel = new Price;
        $searchModel = new PriceSearch();
        $model = $this->findModel($id);
        $typeParams = Yii::$app->request->queryParams;
        $typeParams['PriceSearch']['item_id'] = $id;
        $dataProvider = $searchModel->search($typeParams);

        $searchModificationModel = new ModificationSearch();
        $typeParams['ModificationSearch']['product_id'] = $id;
        $modificationDataProvider = $searchModificationModel->search($typeParams);
        $modificationModel = new Modification;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->saveTranslations();
            $module = $this->module;
            $productEvent = new ProductEvent(['model' => $model]);
            $this->module->trigger($module::EVENT_PRODUCT_UPDATE, $productEvent);

            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'module' => $this->module,
                'modificationModel' => $modificationModel,
                'searchModificationModel' => $searchModificationModel,
                'modificationDataProvider' => $modificationDataProvider,
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
                'priceModel' => $priceModel,
            ]);
        }
    }

    public function actionCreate()
    {
        $model = new Product();
        $priceModel = new Price;

        $priceTypes = PriceType::find()->orderBy('sort DESC')->all();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->saveTranslations();

            if($prices = yii::$app->request->post('Price')) {
                foreach($prices as $typeId => $price) {
                    $model->setPrice($price['price'], $typeId);
                }
            }

            $module = $this->module;
            $productEvent = new ProductEvent(['model' => $model]);
            $this->module->trigger($module::EVENT_PRODUCT_CREATE, $productEvent);

            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'priceModel' => $priceModel,
                'priceTypes' => $priceTypes,
            ]);
        }
    }

    protected function findModel($id)
    {
        $model = new Product();

        if (($model = $model::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}