<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\SignUpForm;
use app\models\ContactForm;
use yii\mongodb\Query;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

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

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $loginmodel = new LoginForm();
        $signupmodel = new SignUpForm();
        if ($loginmodel->load(Yii::$app->request->post()) && $loginmodel->login()) {
            return $this->goBack();
        }
        else if ($signupmodel->load(Yii::$app->request->post()) && $signupmodel->signup()) {
            return $this->goBack();
        }
        else {
            return $this->render('login', [
                'loginmodel' => $loginmodel,
                'signupmodel' => $signupmodel,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionBrowse()
    {
        $query = new Query;
        $query->select(['_id','name', 'description', 'website', 'os'])
            ->from('products');
        $products = $query->all();
        return $this->render('browse', [
            'products' => $products,
        ]);
    }

    public function actionProduct($id)
    {
        $query = new Query;
        $query->select(['_id','name', 'description', 'website', 'os'])->from('products')->where(['_id' => $id]);
        $product = $query->one();

        return $this->render('product', [
            'product' => $product,
        ]);
    }

    public function actionAddproduct($name, $description, $website, $os)
    {
        $collection = \Yii::$app->mongodb->getCollection('products');
        return $collection->insert(['name' => $name, 'description' => $description, 'website' => $website, 'os' => $os]);
        return "done";
    }
}
