<?php

namespace frontend\controllers\user;

use yii\web\NotFoundHttpException;

class ProfileController extends \dektrium\user\controllers\ProfileController
{
    public $layout = '@frontend/views/layouts/main.php'; // optional custom layout

    public function actionUpdate(){

        return parent::actionUpdate();
    }

    /**
     * Shows user's profile.
     *
     * @param int $id
     *
     * @return \yii\web\Response
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionShow($id)
    {
        $profile = $this->finder->findProfileById($id);

        if ($profile === null) {
            throw new NotFoundHttpException();
        }

        return $this->render('show', [
            'profile' => $profile,
        ]);
    }

}
