<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

class LanguageController extends Controller
{
    public function actionSwitch($lang)
    {
        // supported languages — adjust as needed
        $languages = Yii::$app->params['languages'];

        if (in_array($lang, $languages)) {
            Yii::$app->session->set('lang', $lang);
            Yii::$app->language = $lang;
        }

        // Redirect back
        return $this->goBack(Yii::$app->request->referrer ?: '/');
    }
}
