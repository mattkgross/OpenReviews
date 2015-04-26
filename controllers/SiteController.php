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
    public $enableCsrfValidation = false;

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

        $query = new Query;
        $query->select(['_id','name', 'description', 'website', 'os'])
            ->from('products');
        $products = $query->all();

        $prods = array();
        foreach($products as $product) {
            $query = new Query;
            $query->select(['username','rating', 'comment'])->from('reviews')->where(['prodId' => (string)$product['_id']]);
            $reviews = $query->all();

            if(count($reviews)) {
                $avgReview = 0;
                foreach ($reviews as $review) {
                    $avgReview += intval($review['rating']);
                }
                $avgReview = $avgReview / count($reviews);
                $product['avgRating'] = round($avgReview,2);
            }
            else {
                $product['avgRating'] = "No Reviews";
            }

            array_push($prods, $product);
        }


        usort( $prods, function( $a, $b ) {
            return floatval($a['avgRating']) == floatval($b['avgRating']) ? 0 : (floatval($a['avgRating']) < floatval($b['avgRating'])) ? 1 : -1;
        });

        $prods = array_slice($prods,0, 3);

        $query = new Query;
        $query->select(['prodId','username','rating', 'comment'])->from('reviews');
        $reviews = $query->all();

        $reviews = array_reverse($reviews);
        $reviews = array_slice($reviews, 0, 3);

        return $this->render('index', [
            'prods' => $prods,
            'reviews' => $reviews,
        ]);
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

        $prods = array();
        foreach($products as $product) {
            $query = new Query;
            $query->select(['username','rating', 'comment'])->from('reviews')->where(['prodId' => (string)$product['_id']]);
            $reviews = $query->all();

            if(count($reviews)) {
                $avgReview = 0;
                foreach ($reviews as $review) {
                    $avgReview += intval($review['rating']);
                }
                $avgReview = $avgReview / count($reviews);
                $product['avgRating'] = round($avgReview,2);
            }
            else {
                $product['avgRating'] = "No Reviews";
            }

            array_push($prods, $product);
        }

        usort( $prods, function( $a, $b ) {
            return $a['name'] == $b['name'] ? 0 : ($a['name'] > $b['name']) ? 1 : -1;
        });

        return $this->render('browse', [
            'products' => $prods,
        ]);
    }

    public function actionProduct($id)
    {
        $query = new Query;
        $query->select(['_id','name', 'description', 'website', 'os'])->from('products')->where(['_id' => $id]);
        $product = $query->one();

        $query = new Query;
        $query->select(['username','rating', 'comment'])->from('reviews')->where(['prodId' => $id]);
        $reviews = $query->all();

        return $this->render('product', [
            'product' => $product,
            'reviews' => $reviews,
        ]);
    }

    public function actionAddreview() {
        $post = Yii::$app->request->post();
        $rating = $post['rating'];
        $comment = $post['comment'];
        $prodId = $post['prodId'];

        $collection = \Yii::$app->mongodb->getCollection('reviews');
        $collection->insert(['prodId' => $prodId, 'username' => Yii::$app->user->identity->username, 'rating' => $rating, 'comment' => $comment]);

        return $this->redirect(array('/product', 'id' => $prodId));
    }

    public function actionAddproduct($name, $description, $website, $os)
    {
        $collection = \Yii::$app->mongodb->getCollection('products');
        return $collection->insert(['name' => $name, 'description' => $description, 'website' => $website, 'os' => $os]);
        return "done";
    }
}
