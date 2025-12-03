<?php

namespace backend\controllers;

use Yii;
use common\models\SourceMessage;
use common\models\SourceMessageSearch;
use yii\web\Controller;

class TranslationController extends Controller
{
    public function actionIndex()
    {
        $search = new SourceMessageSearch();
        $dataProvider = $search->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $search,
            'dataProvider' => $dataProvider,
            'languages' => Yii::$app->params['availableLanguages'],
        ]);
    }

    public function actionUpdate($id)
    {
        $model = SourceMessage::findOne($id);
        $languages = Yii::$app->params['availableLanguages'];

        if (Yii::$app->request->isPost) {
            foreach ($languages as $lang => $label) {
                $value = Yii::$app->request->post('translation')[$lang] ?? null;
                $model->setTranslation($lang, $value);
            }
            Yii::$app->session->setFlash('success', 'Translations updated.');
            return $this->refresh();
        }

        return $this->render('update', [
            'model' => $model,
            'languages' => $languages,
        ]);
    }
}
