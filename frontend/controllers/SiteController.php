<?php
namespace frontend\controllers;

use common\models\Slider;
use dvizh\order\controllers\OrderController;
use dvizh\order\Order;
use dvizh\shop\models\Producer;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use dvizh\shop\models\Category;
use dvizh\shop\models\Product;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $categories = Category::find()->all();
        $sliders = Slider::find()->all();

        $newArrivals = new ActiveDataProvider([
            'query' => \dvizh\shop\models\Product::find()
                ->where(['available' => 'yes', 'is_new' => 'yes'])
                ->orderBy(['id' => SORT_DESC])  // latest products
                ->limit(10),
            'pagination' => false,
        ]);

        $trending = new ActiveDataProvider([
            'query' => \dvizh\shop\models\Product::find()
                ->where(['available' => 'yes', 'is_popular' => 'yes'])
                ->orderBy(['id' => SORT_DESC])
                ->limit(12),
            'pagination' => false,
        ]);

        $specials = new ActiveDataProvider([
            'query' => \dvizh\shop\models\Product::find()
                ->where(['available' => 'yes', 'is_promo' => 'yes'])
                ->orderBy(['id' => SORT_DESC])
                ->limit(12),
            'pagination' => false,
        ]);

        $producers = Producer::find()->all();

        if($catId = yii::$app->request->get('categoryId')) {
            $category = Category::findOne($catId);
        } elseif($categories) {
            $category = current($categories);
        } else {
            $category = null;
        }

        if($category) {
            $query = Product::find()->category($category->id)->orderBy('id DESC');
        } else {
            $query = Product::find()->orderBy('id DESC');
        }

        $queryForFilter = clone $query;

        if($filter = yii::$app->request->get('filter')) {
            $query->filtered($filter);
        }

        $products = $query->limit(12)->all();

        return $this->render('index', [
            'queryForFilter' => $queryForFilter,
            'categories' => $categories,
            'products' => $products,
            'category' => $category,
            'producers' => $producers,
            'sliders' => $sliders,
            'newArrivals' => $newArrivals,
            'trending' => $trending,
            'specials' => $specials,
        ]);
    }

    public function actionThanks($id)
    {
        $model = \dvizh\order\models\Order::findOne(['id' => $id]);
        return $this->render('thanks', [
            'model' => $model
        ]);
    }

    public function actionCheckout(){

        return $this->render('checkout', [

        ]);
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
