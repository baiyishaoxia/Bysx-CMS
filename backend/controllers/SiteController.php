<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use backend\models\LoginForm;
use yii\filters\VerbFilter;
use yii\captcha\CaptchaAction;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error','captcha'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
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

    /**
     * @inheritdoc
     */
    public function actions()
    {   
        $captcha = [
            'class' => CaptchaAction::className(),
            'backColor' => 0x616161,//背景颜色
            'maxLength' => 3,//最大显示个数
            'minLength' => 3,//最少显示个数
            'padding' => 3,//验证码字体大小，数值越小字体越大
            'height' => 34,//高度
            'width' => 100,//宽度
            'foreColor' => 0xffffff,//字体颜色
            'offset' => 13,//设置字符偏移量
        ];

        return [
            'captcha' => $captcha,
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
  
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {   
        //设置新的布局文件
        $this->layout='login.php';
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
